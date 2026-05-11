<?php
session_start();

function app_path($path = '') {
    $base = dirname(__DIR__);
    return rtrim($base . '/' . ltrim($path, '/'), '/');
}

function storage_read($file, $default = []) {
    $path = app_path('data/' . $file);
    if (!file_exists($path)) return $default;
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return is_array($data) ? $data : $default;
}

function storage_write($file, $data) {
    $path = app_path('data/' . $file);
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function init_storage() {
    $users = storage_read('users.json', []);
    if (!$users) {
        storage_write('users.json', [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ]
        ]);
    }
    if (!file_exists(app_path('data/bookings.json'))) storage_write('bookings.json', []);
    if (!file_exists(app_path('data/packages.json'))) storage_write('packages.json', []);
    if (!file_exists(app_path('data/users.json'))) {
        storage_write('users.json', [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ]
        ]);
    }
}

init_storage();

function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function is_logged_in() {
    return !empty($_SESSION['user']);
}

function is_admin() {
    return is_logged_in() && (($_SESSION['user']['role'] ?? '') === 'admin');
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

function flash_set($type, $msg) {
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

function flash_get() {
    if (empty($_SESSION['flash'])) return null;
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function redirect($to) {
    header("Location: $to");
    exit;
}

function packages_all() {
    $items = storage_read('packages.json', []);
    if (!$items) {
        global $packagesSeed;
        $items = $packagesSeed ?? [];
        storage_write('packages.json', $items);
    }
    return $items;
}

function countries_all() {
    return storage_read('countries.json', []);
}

function users_all() {
    return storage_read('users.json', []);
}

function save_user($user) {
    $users = users_all();
    $users[] = $user;
    storage_write('users.json', $users);
}

function next_id($items) {
    $max = 0;
    foreach ($items as $item) {
        $max = max($max, (int)($item['id'] ?? 0));
    }
    return $max + 1;
}

function find_item_by_id($items, $id) {
    foreach ($items as $item) {
        if ((int)($item['id']) === (int)$id) return $item;
    }
    return null;
}

function update_item($items, $id, $payload) {
    foreach ($items as &$item) {
        if ((int)($item['id']) === (int)$id) {
            $item = array_merge($item, $payload);
            break;
        }
    }
    return $items;
}

function delete_item($items, $id) {
    return array_values(array_filter($items, fn($item) => (int)$item['id'] !== (int)$id));
}

function upload_image($field) {
    if (empty($_FILES[$field]['name'])) return null;
    $uploadDir = app_path('uploads');
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    $name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES[$field]['name']));
    $target = $uploadDir . '/' . $name;
    if (move_uploaded_file($_FILES[$field]['tmp_name'], $target)) {
        return 'uploads/' . $name;
    }
    return null;
}
?>
