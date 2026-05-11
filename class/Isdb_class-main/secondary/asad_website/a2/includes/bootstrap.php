<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data.php';

date_default_timezone_set(APP_TZ);

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string {
    $base = rtrim(APP_URL, '/');
    return $path ? $base . '/' . ltrim($path, '/') : $base;
}

function db(): ?PDO {
    static $pdo = null;
    static $checked = false;
    if ($checked) {
        return $pdo;
    }
    $checked = true;
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (Throwable $e) {
        $pdo = null;
    }
    return $pdo;
}

function db_available(): bool {
    return db() instanceof PDO;
}

function csrf_token(): string {
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf'];
}

function csrf_field(): string {
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): bool {
    return isset($_POST['_csrf'], $_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], (string)$_POST['_csrf']);
}

function flash(string $key, ?string $message = null) {
    if ($message === null) {
        $value = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }
    $_SESSION['_flash'][$key] = $message;
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool {
    return !empty($_SESSION['user']);
}

function login_user(array $user): void {
    $_SESSION['user'] = [
        'id' => (int)$user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'] ?? 'buyer',
        'language' => $user['language'] ?? 'en',
        'currency' => $user['currency'] ?? DEFAULT_CURRENCY,
    ];
}

function logout_user(): void {
    unset($_SESSION['user']);
}

function require_login(): void {
    if (!is_logged_in()) {
        flash('error', 'Please login first.');
        header('Location: login.php');
        exit;
    }
}

function require_role(array $roles): void {
    require_login();
    $role = current_user()['role'] ?? '';
    if (!in_array($role, $roles, true)) {
        http_response_code(403);
        exit('Forbidden');
    }
}

function lang(): string {
    return $_SESSION['lang'] ?? 'en';
}

function set_lang(string $value): void {
    $_SESSION['lang'] = in_array($value, ['en','bn'], true) ? $value : 'en';
}

$T = [
    'en' => [
        'home' => 'Home', 'buy' => 'Buy', 'rent' => 'Rent', 'sell' => 'Sell', 'admin' => 'Admin',
        'list_property' => 'List Property', 'login' => 'Login', 'search' => 'Search', 'compare' => 'Compare',
        'dashboard' => 'Dashboard', 'wishlist' => 'Wishlist', 'booking' => 'Booking', 'calculator' => 'Calculator',
    ],
    'bn' => [
        'home' => 'হোম', 'buy' => 'কিনুন', 'rent' => 'ভাড়া', 'sell' => 'বিক্রি', 'admin' => 'অ্যাডমিন',
        'list_property' => 'প্রপার্টি দিন', 'login' => 'লগইন', 'search' => 'খুঁজুন', 'compare' => 'তুলনা',
        'dashboard' => 'ড্যাশবোর্ড', 'wishlist' => 'পছন্দের তালিকা', 'booking' => 'বুকিং', 'calculator' => 'ক্যালকুলেটর',
    ],
];

function t(string $key): string {
    global $T;
    $lang = lang();
    return $T[$lang][$key] ?? $T['en'][$key] ?? $key;
}

function money(float|int|string $amount, string $currency = DEFAULT_CURRENCY): string {
    $n = is_numeric($amount) ? (float)$amount : 0;
    if ($n >= 1000000) {
        $show = number_format($n / 1000000, 2) . 'M';
    } elseif ($n >= 1000) {
        $show = number_format($n / 1000, 1) . 'K';
    } else {
        $show = number_format($n, 0);
    }
    return '$' . $show;
}

function tables_exist(): bool {
    if (!db_available()) return false;
    try {
        $stmt = db()->query("SHOW TABLES LIKE 'properties'");
        return (bool)$stmt->fetchColumn();
    } catch (Throwable $e) {
        return false;
    }
}

function demo_properties(): array {
    global $demoProperties;
    return $demoProperties;
}

function demo_trending(): array {
    global $demoTrendingLocations;
    return $demoTrendingLocations;
}

function demo_featured(): array {
    return array_values(array_filter(demo_properties(), fn($p) => !empty($p['featured'])));
}

function property_card_data(array $row): array {
    $row['images'] = $row['images'] ?? [
        'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
    ];
    $row['image'] = $row['images'][0];
    $row['rating'] = $row['rating'] ?? 4.8;
    $row['views'] = $row['views'] ?? 0;
    return $row;
}

function get_properties(array $filters = []): array {
    if (!tables_exist()) {
        $items = demo_properties();
    } else {
        $sql = "SELECT p.*, COALESCE(AVG(r.rating), 0) AS rating, COUNT(DISTINCT v.id) AS views
                FROM properties p
                LEFT JOIN reviews r ON r.property_id = p.id
                LEFT JOIN page_views v ON v.property_id = p.id";
        $conds = [];
        $params = [];
        if (!empty($filters['q'])) {
            $conds[] = '(p.title LIKE :q OR p.city LIKE :q OR p.neighborhood LIKE :q OR p.address LIKE :q)';
            $params[':q'] = '%' . $filters['q'] . '%';
        }
        if (!empty($filters['city'])) {
            $conds[] = 'p.city = :city';
            $params[':city'] = $filters['city'];
        }
        if (!empty($filters['listing_type'])) {
            $conds[] = 'p.listing_type = :listing_type';
            $params[':listing_type'] = $filters['listing_type'];
        }
        if (!empty($filters['status'])) {
            $conds[] = 'p.status = :status';
            $params[':status'] = $filters['status'];
        }
        if (!empty($filters['type'])) {
            $conds[] = 'p.property_type = :type';
            $params[':type'] = $filters['type'];
        }
        if (!empty($filters['min_price'])) {
            $conds[] = 'p.price >= :min_price';
            $params[':min_price'] = (float)$filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $conds[] = 'p.price <= :max_price';
            $params[':max_price'] = (float)$filters['max_price'];
        }
        if (!empty($filters['bedrooms'])) {
            $conds[] = 'p.bedrooms >= :bedrooms';
            $params[':bedrooms'] = (int)$filters['bedrooms'];
        }
        if ($conds) {
            $sql .= ' WHERE ' . implode(' AND ', $conds);
        }
        $sql .= ' GROUP BY p.id ORDER BY p.featured DESC, p.created_at DESC';
        $stmt = db()->prepare($sql);
        $stmt->execute($params);
        $items = $stmt->fetchAll();
    }
    $items = array_map('property_card_data', $items);
    return $items;
}

function get_property($idOrSlug): ?array {
    if (!tables_exist()) {
        foreach (demo_properties() as $item) {
            if ((string)$item['id'] === (string)$idOrSlug || (string)$item['slug'] === (string)$idOrSlug) {
                return property_card_data($item);
            }
        }
        return null;
    }
    $stmt = db()->prepare("SELECT p.*, COALESCE(AVG(r.rating), 0) AS rating, COUNT(DISTINCT v.id) AS views
        FROM properties p
        LEFT JOIN reviews r ON r.property_id = p.id
        LEFT JOIN page_views v ON v.property_id = p.id
        WHERE p.id = :id OR p.slug = :slug
        GROUP BY p.id LIMIT 1");
    $stmt->execute([':id' => $idOrSlug, ':slug' => $idOrSlug]);
    $row = $stmt->fetch();
    return $row ? property_card_data($row) : null;
}

function get_property_media(int $propertyId): array {
    if (!tables_exist()) {
        $property = get_property($propertyId);
        return $property['images'] ?? [];
    }
    $stmt = db()->prepare('SELECT * FROM property_media WHERE property_id = ? ORDER BY sort_order ASC, id ASC');
    $stmt->execute([$propertyId]);
    $rows = $stmt->fetchAll();
    return $rows ?: [];
}

function get_trending_locations(): array {
    if (!tables_exist()) return demo_trending();
    $stmt = db()->query('SELECT city AS name, CONCAT(COUNT(*), " homes") AS count FROM properties GROUP BY city ORDER BY COUNT(*) DESC LIMIT 6');
    return $stmt->fetchAll() ?: demo_trending();
}

function get_featured_properties(): array {
    if (!tables_exist()) return demo_featured();
    $stmt = db()->query("SELECT p.*, COALESCE(AVG(r.rating), 0) AS rating, COUNT(DISTINCT v.id) AS views
        FROM properties p
        LEFT JOIN reviews r ON r.property_id = p.id
        LEFT JOIN page_views v ON v.property_id = p.id
        WHERE p.featured = 1 AND p.status IN ('live','pending')
        GROUP BY p.id ORDER BY p.created_at DESC LIMIT 6");
    return array_map('property_card_data', $stmt->fetchAll() ?: demo_featured());
}

function user_stats(?int $userId = null): array {
    if (!tables_exist()) {
        return ['wishlist' => 2, 'bookings' => 1, 'inquiries' => 3, 'views' => 12];
    }
    $userId = $userId ?? (int)(current_user()['id'] ?? 0);
    $pdo = db();
    $stats = [
        'wishlist' => (int)$pdo->query("SELECT COUNT(*) FROM favorites WHERE user_id = {$userId}")->fetchColumn(),
        'bookings' => (int)$pdo->query("SELECT COUNT(*) FROM bookings WHERE user_id = {$userId}")->fetchColumn(),
        'inquiries' => (int)$pdo->query("SELECT COUNT(*) FROM inquiries WHERE user_id = {$userId}")->fetchColumn(),
        'views' => (int)$pdo->query("SELECT COUNT(*) FROM page_views WHERE user_id = {$userId}")->fetchColumn(),
    ];
    return $stats;
}

function recent_views(int $limit = 6): array {
    if (!tables_exist()) {
        $props = get_featured_properties();
        return array_slice($props, 0, $limit);
    }
    $userId = (int)(current_user()['id'] ?? 0);
    $stmt = db()->prepare("SELECT p.*, pv.created_at AS viewed_at FROM page_views pv JOIN properties p ON p.id = pv.property_id WHERE pv.user_id = ? ORDER BY pv.created_at DESC LIMIT ?");
    $stmt->bindValue(1, $userId, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return array_map('property_card_data', $stmt->fetchAll() ?: []);
}
