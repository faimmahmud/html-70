<?php
require_once __DIR__ . '/functions.php';
header('Content-Type: application/json');

ensure_storage();

$bookingType = trim($_POST['booking_type'] ?? 'package');
$packageId = trim($_POST['package_id'] ?? '');
$packageName = trim($_POST['package_name'] ?? '');
$country = trim($_POST['country'] ?? '');
$departureFrom = trim($_POST['departure_from'] ?? '');
$destination = trim($_POST['destination'] ?? '');
$travelDate = trim($_POST['travel_date'] ?? '');
$travelTime = trim($_POST['travel_time'] ?? '');
$leaveDate = trim($_POST['leave_date'] ?? '');
$leaveTime = trim($_POST['leave_time'] ?? '');
$guests = max(1, (int)($_POST['guests'] ?? 1));
$name = trim($_POST['customer_name'] ?? '');
$email = trim($_POST['customer_email'] ?? '');
$phone = trim($_POST['customer_phone'] ?? '');
$paymentMethod = trim($_POST['payment_method'] ?? 'cash');
$paymentReference = trim($_POST['payment_reference'] ?? '');
$amount = parse_amount($_POST['amount'] ?? 0);
$currency = trim($_POST['currency'] ?? 'USD');
$message = trim($_POST['message'] ?? '');

if ($packageName === '' && $packageId !== '') {
    foreach (read_packages() as $pkg) {
        if (($pkg['id'] ?? '') === $packageId) {
            $packageName = $pkg['title'] ?? $packageName;
            $country = $country !== '' ? $country : ($pkg['country'] ?? '');
            if ($amount <= 0) {
                $amount = parse_amount($pkg['price'] ?? 0);
            }
            break;
        }
    }
}

if ($bookingType === '' || $packageName === '' || $name === '' || $email === '' || $phone === '' || $travelDate === '' || $leaveDate === '' || $travelTime === '' || $leaveTime === '') {
    echo json_encode(['success' => false, 'message' => 'Please complete all booking, travel, and contact fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$paymentMethods = ['cash', 'bkash', 'nagad', 'rocket', 'card', 'bank', 'paypal'];
if (!in_array($paymentMethod, $paymentMethods, true)) {
    $paymentMethod = 'cash';
}

$currentUser = current_user();

if (!$currentUser) {
    echo json_encode(['success' => false, 'message' => 'Please log in or register before booking tickets.']);
    exit;
}

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
    'currency' => $currency !== '' ? $currency : 'USD',
    'message' => $message,
    'booked_by' => $currentUser['email'] ?? 'guest',
    'booked_role' => $currentUser['role'] ?? 'guest',
    'booking_channel' => 'website',
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
]);

echo json_encode(['success' => true, 'message' => 'Booking submitted successfully. We will contact you shortly.']);
