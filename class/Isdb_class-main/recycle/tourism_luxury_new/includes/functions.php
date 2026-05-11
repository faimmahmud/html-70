<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/travel-data.php';

function site_root(): string {
    $dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
    if (preg_match('~/(admin|includes|assets)$~', $dir)) {
        $dir = dirname($dir);
    }
    return $dir === '/' ? '' : $dir;
}

function app_path(string $file = ''): string {
    $root = site_root();
    return $root . '/' . ltrim($file, '/');
}

function asset(string $path): string {
    return app_path($path);
}

function load_json(string $file, array $default = []): array {
    if (!file_exists($file)) {
        return $default;
    }
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : $default;
}

function save_json(string $file, array $data): bool {
    $dir = dirname($file);
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX) !== false;
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function is_admin(): bool {
    return isset($_SESSION['user']) && (($_SESSION['user']['role'] ?? 'user') === 'admin');
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function flash_set(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function redirect(string $path): void {
    header('Location: ' . $path);
    exit;
}

function user_store_path(): string {
    return __DIR__ . '/../data/users.json';
}

function package_store_path(): string {
    return __DIR__ . '/../data/packages.json';
}

function booking_store_path(): string {
    return __DIR__ . '/../data/bookings.json';
}

function first_non_empty(...$values): string {
    foreach ($values as $value) {
        if (is_string($value) || is_numeric($value)) {
            $value = (string)$value;
            if (trim($value) !== '') {
                return $value;
            }
        }
    }
    return '';
}

function db_path(): string {
    return __DIR__ . '/../data/aurelia.sqlite';
}

function read_packages(): array {
    return load_json(package_store_path(), []);
}

function write_packages(array $packages): bool {
    return save_json(package_store_path(), array_values($packages));
}

function read_users(): array {
    return load_json(user_store_path(), []);
}

function write_users(array $users): bool {
    return save_json(user_store_path(), array_values($users));
}

function booking_defaults(): array {
    return [
        'booking_type' => 'package',
        'package_id' => '',
        'package_name' => '',
        'country' => '',
        'departure_from' => '',
        'destination' => '',
        'travel_date' => '',
        'travel_time' => '',
        'leave_date' => '',
        'leave_time' => '',
        'guests' => 1,
        'customer_name' => '',
        'customer_email' => '',
        'customer_phone' => '',
        'payment_method' => 'cash',
        'payment_reference' => '',
        'payment_status' => 'pending',
        'booking_status' => 'pending',
        'amount' => 0,
        'currency' => 'USD',
        'message' => '',
        'booked_by' => 'guest',
        'booked_role' => 'guest',
        'booking_channel' => 'website',
        'ip_address' => '',
        'user_agent' => '',
        'created_at' => date('c'),
        'updated_at' => date('c'),
    ];
}

function normalize_booking_row(array $row): array {
    $mapped = $row;
    $mapped['package_name'] = first_non_empty($mapped['package_name'] ?? '', $mapped['package'] ?? '');
    $mapped['customer_name'] = first_non_empty($mapped['customer_name'] ?? '', $mapped['name'] ?? '');
    $mapped['customer_email'] = first_non_empty($mapped['customer_email'] ?? '', $mapped['email'] ?? '');
    $mapped['customer_phone'] = first_non_empty($mapped['customer_phone'] ?? '', $mapped['phone'] ?? '');
    $mapped['travel_date'] = first_non_empty($mapped['travel_date'] ?? '', $mapped['date'] ?? '');
    $mapped['guests'] = first_non_empty($mapped['guests'] ?? '', $mapped['people'] ?? 1);
    $mapped['message'] = first_non_empty($mapped['message'] ?? '');
    $mapped['country'] = first_non_empty($mapped['country'] ?? '');
    $booking = array_merge(booking_defaults(), $mapped);
    $booking['id'] = (string)($row['id'] ?? '');
    $booking['guests'] = max(1, (int)($booking['guests'] ?? 1));
    $booking['amount'] = (float)($booking['amount'] ?? 0);
    $booking['booking_ref'] = (string)($row['booking_ref'] ?? '');
    if ($booking['booking_ref'] === '') {
        $booking['booking_ref'] = 'BK-' . strtoupper(substr(md5($booking['id'] . microtime(true)), 0, 8));
    }
    return $booking;
}

function generate_booking_id(): string {
    return uniqid('bk_', true);
}

function insert_booking(array $data): string {
    $bookings = read_bookings();
    $booking = array_merge(booking_defaults(), $data);
    $booking['id'] = $booking['id'] ?? generate_booking_id();
    $booking['booking_ref'] = $booking['booking_ref'] ?? ('BK-' . strtoupper(bin2hex(random_bytes(4))));
    $booking['guests'] = max(1, (int)$booking['guests']);
    $booking['amount'] = (float)$booking['amount'];
    $booking['created_at'] = $booking['created_at'] ?: date('c');
    $booking['updated_at'] = date('c');
    $bookings[] = normalize_booking_row($booking);
    write_bookings($bookings);
    return (string)$booking['id'];
}

function read_bookings(): array {
    $rows = load_json(booking_store_path(), []);
    $rows = array_map('normalize_booking_row', $rows ?: []);
    usort($rows, function ($a, $b) {
        return strcmp($b['created_at'] ?? '', $a['created_at'] ?? '') ?: strcmp((string)($b['id'] ?? ''), (string)($a['id'] ?? ''));
    });
    return $rows;
}

function write_bookings(array $bookings): bool {
    $prepared = [];
    foreach ($bookings as $booking) {
        $prepared[] = normalize_booking_row($booking);
    }
    return save_json(booking_store_path(), array_values($prepared));
}

function find_booking_by_id(string $id): ?array {
    foreach (read_bookings() as $booking) {
        if ((string)($booking['id'] ?? '') === (string)$id) {
            return $booking;
        }
    }
    return null;
}

function find_booking_by_ref(string $ref): ?array {
    foreach (read_bookings() as $booking) {
        if ((string)($booking['booking_ref'] ?? '') === (string)$ref) {
            return $booking;
        }
    }
    return null;
}

function update_booking(string $id, array $data): bool {
    $bookings = read_bookings();
    $updated = false;
    foreach ($bookings as &$booking) {
        if ((string)($booking['id'] ?? '') === (string)$id) {
            foreach ($data as $key => $value) {
                if ($key === 'guests') {
                    $booking[$key] = max(1, (int)$value);
                } elseif ($key === 'amount') {
                    $booking[$key] = (float)$value;
                } else {
                    $booking[$key] = $value;
                }
            }
            $booking['updated_at'] = date('c');
            $booking = normalize_booking_row($booking);
            $updated = true;
            break;
        }
    }
    unset($booking);
    if ($updated) {
        write_bookings($bookings);
    }
    return $updated;
}

function delete_booking(string $id): bool {
    $bookings = read_bookings();
    $before = count($bookings);
    $bookings = array_values(array_filter($bookings, fn($booking) => (string)($booking['id'] ?? '') !== (string)$id));
    if (count($bookings) === $before) {
        return false;
    }
    write_bookings($bookings);
    return true;
}

function booking_stats(): array {
    $bookings = read_bookings();
    $stats = [
        'total' => 0,
        'pending' => 0,
        'confirmed' => 0,
        'completed' => 0,
        'unpaid' => 0,
        'revenue' => 0.0,
    ];
    foreach ($bookings as $b) {
        $stats['total']++;
        $stats['revenue'] += (float)($b['amount'] ?? 0);
        if (($b['booking_status'] ?? '') === 'pending') $stats['pending']++;
        if (($b['booking_status'] ?? '') === 'confirmed') $stats['confirmed']++;
        if (($b['booking_status'] ?? '') === 'completed') $stats['completed']++;
        if (($b['payment_status'] ?? '') === 'pending') $stats['unpaid']++;
    }
    return $stats;
}

function parse_amount($value): float {
    if (is_numeric($value)) {
        return (float)$value;
    }
    $clean = preg_replace('/[^0-9.]/', '', (string)$value);
    return $clean === '' ? 0.0 : (float)$clean;
}

function handle_image_upload(string $field, string $existing = ''): string {
    if (!isset($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return $existing;
    }

    $tmp = $_FILES[$field]['tmp_name'];
    $name = basename($_FILES[$field]['name']);
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($ext, $allowed, true)) {
        return $existing;
    }

    $uploadDir = __DIR__ . '/../uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $newName = uniqid('img_', true) . '.' . $ext;
    $target = $uploadDir . '/' . $newName;
    if (move_uploaded_file($tmp, $target)) {
        return app_path('uploads/' . $newName);
    }

    return $existing;
}

function ensure_storage(): void {
    foreach ([__DIR__ . '/../data', __DIR__ . '/../uploads'] as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
    }
}
