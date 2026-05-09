<?php
require_once __DIR__ . '/functions.php';
header('Content-Type: application/json; charset=utf-8');

ensure_storage();

function booking_json(bool $success, string $message, int $status = 200): void {
    http_response_code($status);
    echo json_encode(['success' => $success, 'message' => $message], JSON_UNESCAPED_SLASHES);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    booking_json(false, 'Invalid request method.', 405);
}

if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    booking_json(false, 'Security check failed. Please refresh the page and try again.', 403);
}

$bookingType = strtolower(trim((string)($_POST['booking_type'] ?? 'package')));
$allowedBookingTypes = ['package', 'ticket', 'tour'];
if (!in_array($bookingType, $allowedBookingTypes, true)) {
    $bookingType = 'package';
}

$packageId = trim((string)($_POST['package_id'] ?? ''));
$packageName = trim((string)($_POST['package_name'] ?? ''));
$country = trim((string)($_POST['country'] ?? ''));
$departureFrom = trim((string)($_POST['departure_from'] ?? ''));
$destination = trim((string)($_POST['destination'] ?? ''));
$travelDate = trim((string)($_POST['travel_date'] ?? ''));
$travelTime = trim((string)($_POST['travel_time'] ?? ''));
$leaveDate = trim((string)($_POST['leave_date'] ?? ''));
$leaveTime = trim((string)($_POST['leave_time'] ?? ''));
$guests = max(1, (int)($_POST['guests'] ?? 1));
$name = trim((string)($_POST['customer_name'] ?? ''));
$email = trim((string)($_POST['customer_email'] ?? ''));
$phone = trim((string)($_POST['customer_phone'] ?? ''));
$paymentMethod = strtolower(trim((string)($_POST['payment_method'] ?? 'cash')));
$paymentReference = trim((string)($_POST['payment_reference'] ?? ''));
$amount = max(0, parse_amount($_POST['amount'] ?? 0));
$currency = strtoupper(trim((string)($_POST['currency'] ?? 'USD')));
$message = trim((string)($_POST['message'] ?? ''));

$allowedCurrencies = ['USD', 'BDT', 'EUR', 'GBP', 'CAD', 'AUD'];
if (!in_array($currency, $allowedCurrencies, true)) {
    $currency = 'USD';
}

$paymentMethods = ['cash', 'bkash', 'nagad', 'rocket', 'card', 'bank', 'paypal'];
if (!in_array($paymentMethod, $paymentMethods, true)) {
    $paymentMethod = 'cash';
}

if ($packageName === '' && $packageId !== '') {
    foreach (read_packages() as $pkg) {
        if ((string)($pkg['id'] ?? '') === $packageId) {
            $packageName = (string)($pkg['title'] ?? $packageName);
            $country = $country !== '' ? $country : (string)($pkg['country'] ?? '');
            if ($amount <= 0) {
                $amount = parse_amount($pkg['price'] ?? 0);
            }
            break;
        }
    }
}

$required = [$packageName, $name, $email, $phone, $travelDate, $travelTime, $leaveDate, $leaveTime];
foreach ($required as $value) {
    if ($value === '') {
        booking_json(false, 'Please complete all booking, travel, and contact fields.', 422);
    }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    booking_json(false, 'Please enter a valid email address.', 422);
}

if ($guests < 1) {
    $guests = 1;
}

$currentUser = current_user();

insert_booking([
    'booking_type' => $bookingType,
    'package_id' => $packageId,
    'package_name' => $packageName,
    'country' => $country,
    'departure_from' => $departureFrom,
    'destination' => $destination,
    'travel_date' => $travelDate,
    'travel_time' => $travelTime,
    'leave_date' => $leaveDate,
    'leave_time' => $leaveTime,
    'guests' => $guests,
    'customer_name' => $name,
    'customer_email' => $email,
    'customer_phone' => $phone,
    'payment_method' => $paymentMethod,
    'payment_reference' => $paymentReference,
    'payment_status' => 'pending',
    'booking_status' => 'pending',
    'amount' => $amount,
    'currency' => $currency,
    'message' => $message,
    'booked_by' => $currentUser['email'] ?? 'guest',
    'booked_role' => $currentUser['role'] ?? 'guest',
    'booking_channel' => 'website',
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
]);

booking_json(true, 'Booking submitted successfully. We will contact you shortly.');
