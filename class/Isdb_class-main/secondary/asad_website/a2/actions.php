<?php
require_once __DIR__ . '/includes/bootstrap.php';
header('Content-Type: application/json');

function respond(array $payload, int $code = 200): void {
    http_response_code($code);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Invalid method'], 405);
}
if (!verify_csrf() && ($_POST['action'] ?? '') !== 'toggle_favorite') {
    respond(['success' => false, 'message' => 'Invalid CSRF token'], 403);
}

$action = (string)($_POST['action'] ?? '');
$pdo = db();
$user = current_user();

try {
    if ($action === 'set_lang') {
        set_lang((string)($_POST['lang'] ?? 'en'));
        respond(['success' => true]);
    }

    if ($action === 'register') {
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $name = trim((string)$_POST['name']);
        $email = trim((string)$_POST['email']);
        $password = (string)$_POST['password'];
        $role = in_array($_POST['role'] ?? 'buyer', ['buyer','agent','seller'], true) ? $_POST['role'] : 'buyer';
        $lang = in_array($_POST['language'] ?? 'en', ['en','bn'], true) ? $_POST['language'] : 'en';
        $currency = trim((string)($_POST['currency'] ?? DEFAULT_CURRENCY)) ?: DEFAULT_CURRENCY;
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
            respond(['success' => false, 'message' => 'Please fill in valid registration details.'], 422);
        }
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) respond(['success' => false, 'message' => 'Email already exists.'], 409);
        $stmt = $pdo->prepare('INSERT INTO users (name,email,password_hash,role,language,currency,status,email_verified) VALUES (?,?,?,?,?,?,?,0)');
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $role, $lang, $currency, 'active']);
        respond(['success' => true, 'message' => 'Account created. Please login.']);
    }

    if ($action === 'login') {
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $email = trim((string)$_POST['email']);
        $password = (string)$_POST['password'];
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row || !password_verify($password, $row['password_hash'])) {
            respond(['success' => false, 'message' => 'Invalid email or password.'], 401);
        }
        login_user($row);
        set_lang($row['language'] ?? 'en');
        respond(['success' => true, 'redirect' => 'index.php']);
    }

    if ($action === 'logout') {
        logout_user();
        respond(['success' => true, 'redirect' => 'index.php']);
    }

    if ($action === 'save_property' || $action === 'update_property') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $fields = [
            'title' => trim((string)$_POST['title']),
            'slug' => trim((string)$_POST['slug']),
            'description' => trim((string)$_POST['description']),
            'property_type' => trim((string)$_POST['property_type']),
            'listing_type' => in_array($_POST['listing_type'] ?? 'sale', ['sale','rent','short_stay'], true) ? $_POST['listing_type'] : 'sale',
            'status' => in_array($_POST['status'] ?? 'draft', ['draft','review','live','rejected','sold','rented'], true) ? $_POST['status'] : 'draft',
            'price' => (float)($_POST['price'] ?? 0),
            'currency' => trim((string)($_POST['currency'] ?? DEFAULT_CURRENCY)) ?: DEFAULT_CURRENCY,
            'bedrooms' => (int)($_POST['bedrooms'] ?? 0),
            'bathrooms' => (int)($_POST['bathrooms'] ?? 0),
            'area_sqft' => (int)($_POST['area_sqft'] ?? 0),
            'country' => trim((string)$_POST['country']),
            'city' => trim((string)$_POST['city']),
            'neighborhood' => trim((string)$_POST['neighborhood']),
            'address' => trim((string)$_POST['address']),
            'latitude' => $_POST['latitude'] !== '' ? (float)$_POST['latitude'] : null,
            'longitude' => $_POST['longitude'] !== '' ? (float)$_POST['longitude'] : null,
            'featured' => isset($_POST['featured']) ? 1 : 0,
            'agent_id' => (int)$user['id'],
            'owner_id' => (int)$user['id'],
        ];
        if ($fields['title'] === '' || $fields['slug'] === '' || $fields['price'] <= 0) {
            respond(['success' => false, 'message' => 'Title, slug, and price are required.'], 422);
        }
        $propertyId = (int)($_POST['property_id'] ?? 0);
        if ($action === 'update_property' && $propertyId > 0) {
            $fields['id'] = $propertyId;
            $sql = 'UPDATE properties SET title=:title, slug=:slug, description=:description, property_type=:property_type, listing_type=:listing_type, status=:status, price=:price, currency=:currency, bedrooms=:bedrooms, bathrooms=:bathrooms, area_sqft=:area_sqft, country=:country, city=:city, neighborhood=:neighborhood, address=:address, latitude=:latitude, longitude=:longitude, featured=:featured WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($fields);
        } else {
            $sql = 'INSERT INTO properties (owner_id,agent_id,title,slug,description,property_type,listing_type,status,price,currency,bedrooms,bathrooms,area_sqft,country,city,neighborhood,address,latitude,longitude,featured) VALUES (:owner_id,:agent_id,:title,:slug,:description,:property_type,:listing_type,:status,:price,:currency,:bedrooms,:bathrooms,:area_sqft,:country,:city,:neighborhood,:address,:latitude,:longitude,:featured)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($fields);
            $propertyId = (int)$pdo->lastInsertId();
        }

        // upload images if present
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['name'] as $i => $name) {
                if (($_FILES['images']['error'][$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) continue;
                $tmp = $_FILES['images']['tmp_name'][$i];
                $raw = file_get_contents($tmp);
                if ($raw === false) continue;
                $fileBase = bin2hex(random_bytes(8));
                $ext = 'jpg';
                $mime = mime_content_type($tmp) ?: 'image/jpeg';
                if (str_contains($mime, 'png')) $ext = 'png';
                if (str_contains($mime, 'webp')) $ext = 'webp';
                $target = PROPERTY_UPLOAD_DIR . '/' . $fileBase . '.' . $ext;
                if (!is_dir(PROPERTY_UPLOAD_DIR)) @mkdir(PROPERTY_UPLOAD_DIR, 0775, true);
                move_uploaded_file($tmp, $target);
                $thumbnail = null;
                if (function_exists('imagecreatefromstring') && function_exists('imagewebp')) {
                    $img = @imagecreatefromstring($raw);
                    if ($img) {
                        $thumbPath = PROPERTY_UPLOAD_DIR . '/' . $fileBase . '-thumb.webp';
                        $w = imagesx($img); $h = imagesy($img);
                        $tw = 600; $th = max(1, (int)round($h * ($tw / max($w, 1))));
                        $thumb = imagecreatetruecolor($tw, $th);
                        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $tw, $th, $w, $h);
                        imagewebp($thumb, $thumbPath, 82);
                        imagedestroy($thumb);
                        imagedestroy($img);
                        $thumbnail = 'uploads/properties/' . basename($thumbPath);
                    }
                }
                $stmt = $pdo->prepare('INSERT INTO property_media (property_id,media_type,url,thumbnail_url,sort_order,alt_text) VALUES (?,"image",?,?,?,?)');
                $stmt->execute([$propertyId, 'uploads/properties/' . basename($target), $thumbnail, $i, $fields['title']]);
            }
        }

        $audit = $pdo->prepare('INSERT INTO audit_logs (actor_user_id, action, entity_type, entity_id, metadata_json) VALUES (?,?,?,?,?)');
        $audit->execute([(int)$user['id'], $action, 'property', $propertyId, json_encode($fields)]);
        respond(['success' => true, 'message' => 'Property saved successfully.']);
    }

    if ($action === 'delete_property') {
        require_role(['agent','admin','seller']);
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $id = (int)($_POST['property_id'] ?? 0);
        $stmt = $pdo->prepare('DELETE FROM properties WHERE id = ?');
        $stmt->execute([$id]);
        respond(['success' => true, 'message' => 'Property deleted.']);
    }

    if ($action === 'toggle_favorite') {
        require_login();
        $propertyId = (int)($_POST['property_id'] ?? 0);
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $check = $pdo->prepare('SELECT id FROM favorites WHERE user_id = ? AND property_id = ?');
        $check->execute([(int)$user['id'], $propertyId]);
        if ($check->fetch()) {
            $pdo->prepare('DELETE FROM favorites WHERE user_id = ? AND property_id = ?')->execute([(int)$user['id'], $propertyId]);
            respond(['success' => true, 'saved' => false]);
        }
        $pdo->prepare('INSERT INTO favorites (user_id, property_id) VALUES (?,?)')->execute([(int)$user['id'], $propertyId]);
        respond(['success' => true, 'saved' => true]);
    }

    if ($action === 'save_search') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $name = trim((string)$_POST['name']);
        $query = trim((string)$_POST['query_json']);
        $stmt = $pdo->prepare('INSERT INTO saved_searches (user_id, name, query_json, alerts_enabled) VALUES (?,?,?,1)');
        $stmt->execute([(int)$user['id'], $name, $query]);
        respond(['success' => true, 'message' => 'Search saved.']);
    }

    if ($action === 'send_inquiry') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $propertyId = (int)($_POST['property_id'] ?? 0);
        $message = trim((string)$_POST['message']);
        $agentId = (int)($_POST['agent_id'] ?? 0);
        $stmt = $pdo->prepare('INSERT INTO inquiries (property_id,user_id,agent_id,message,status) VALUES (?,?,?,?,"new")');
        $stmt->execute([$propertyId, (int)$user['id'], $agentId, $message]);
        $pdo->prepare('INSERT INTO leads (property_id,agent_id,user_id,source,status) VALUES (?,?,?,?,"new")')->execute([$propertyId,$agentId,(int)$user['id'],'property page','new']);
        respond(['success' => true, 'message' => 'Inquiry sent.']);
    }

    if ($action === 'create_booking') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $stmt = $pdo->prepare('INSERT INTO bookings (user_id, property_id, agent_id, booking_type, scheduled_at, status, notes, price_snapshot, currency) VALUES (?,?,?,?,?,?,?, ?, ?)');
        $stmt->execute([
            (int)$user['id'],
            (int)($_POST['property_id'] ?? 0),
            (int)($_POST['agent_id'] ?? 0),
            (string)($_POST['booking_type'] ?? 'visit'),
            (string)$_POST['scheduled_at'],
            'pending',
            trim((string)$_POST['notes']),
            (float)($_POST['price_snapshot'] ?? 0),
            (string)($_POST['currency'] ?? DEFAULT_CURRENCY),
        ]);
        respond(['success' => true, 'message' => 'Booking request created.']);
    }

    if ($action === 'create_review') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $stmt = $pdo->prepare('INSERT INTO reviews (user_id, property_id, rating, title, body) VALUES (?,?,?,?,?)');
        $stmt->execute([(int)$user['id'], (int)($_POST['property_id'] ?? 0), (float)$_POST['rating'], trim((string)$_POST['title']), trim((string)$_POST['body'])]);
        respond(['success' => true, 'message' => 'Review submitted.']);
    }

    if ($action === 'save_rate') {
        require_role(['admin']);
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $name = trim((string)$_POST['material_name']);
        $rate = (float)$_POST['rate'];
        $pdo->prepare('INSERT INTO material_rates (material_name, rate, unit, updated_by) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE rate=VALUES(rate), unit=VALUES(unit), updated_by=VALUES(updated_by), updated_at=CURRENT_TIMESTAMP')
            ->execute([$name, $rate, trim((string)$_POST['unit']), (int)$user['id']]);
        respond(['success' => true, 'message' => 'Material rate updated.']);
    }

    if ($action === 'simulate_payment') {
        require_login();
        if (!$pdo) respond(['success' => false, 'message' => 'Database not connected'], 500);
        $bookingId = (int)($_POST['booking_id'] ?? 0);
        $amount = (float)$_POST['amount'];
        $provider = trim((string)($_POST['provider'] ?? 'sslcommerz'));
        $ref = 'TXN-' . strtoupper(bin2hex(random_bytes(4)));
        $pdo->prepare('INSERT INTO transactions (booking_id,payer_id,amount,currency,provider,status,payment_reference) VALUES (?,?,?,?,?,"paid",?)')
            ->execute([$bookingId, (int)$user['id'], $amount, (string)($_POST['currency'] ?? DEFAULT_CURRENCY), $provider, $ref]);
        respond(['success' => true, 'reference' => $ref]);
    }

    respond(['success' => false, 'message' => 'Unknown action'], 400);
} catch (Throwable $e) {
    respond(['success' => false, 'message' => $e->getMessage()], 500);
}
