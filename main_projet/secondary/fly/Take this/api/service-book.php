<?php
declare(strict_types=1);

header('Content-Type: application/json');

$pdo = require __DIR__ . '/../config/db.php';

function clean(string $key): string {
    return trim($_POST[$key] ?? '');
}

$serviceType = clean('service_type');
$fullName = clean('full_name');
$email = clean('email');
$phone = clean('phone');
$travelDate = clean('travel_date');
$details = clean('details');

$allowed = ['hotels', 'car-rentals', 'tours', 'chauffeur', 'meet-greet', 'transfers'];

if ($serviceType === '' || $fullName === '' || $email === '' || $phone === '' || $details === '') {
    echo json_encode(['ok' => false, 'message' => 'Please complete all required fields.']);
    exit;
}

if (!in_array($serviceType, $allowed, true)) {
    echo json_encode(['ok' => false, 'message' => 'Invalid service selected.']);
    exit;
}

$requestCode = 'SR-' . strtoupper(bin2hex(random_bytes(3)));

$stmt = $pdo->prepare("
    INSERT INTO service_requests
    (request_code, service_type, full_name, email, phone, details, travel_date)
    VALUES
    (:request_code, :service_type, :full_name, :email, :phone, :details, :travel_date)
");

$stmt->execute([
    ':request_code' => $requestCode,
    ':service_type' => $serviceType,
    ':full_name' => $fullName,
    ':email' => $email,
    ':phone' => $phone,
    ':details' => $details,
    ':travel_date' => $travelDate ?: null,
]);

echo json_encode(['ok' => true, 'request_code' => $requestCode]);
