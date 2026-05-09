<?php
declare(strict_types=1);

header('Content-Type: application/json');

$pdo = require __DIR__ . '/../config/db.php';

function clean(string $key): string {
    return trim($_POST[$key] ?? '');
}

$fullName = clean('full_name');
$email = clean('email');
$phone = clean('phone');
$destination = clean('destination');
$travelDate = clean('travel_date');
$returnDate = clean('return_date');
$paymentMethod = clean('payment_method');
$transactionRef = clean('transaction_ref');
$passengers = (int)($_POST['passengers'] ?? 0);

$destinationPrices = [
    'Dubai' => 64544,
    'London' => 137201,
    'Bangkok' => 45320,
    'Istanbul' => 62330,
    'Singapore' => 58420,
];

$allowedPayments = ['card', 'bkash', 'nagad', 'rocket', 'paypal', 'bank', 'apple_google'];

if ($fullName === '' || $email === '' || $phone === '' || $destination === '' || $travelDate === '' || $passengers < 1 || $paymentMethod === '') {
    echo json_encode(['ok' => false, 'message' => 'Please complete all required fields.']);
    exit;
}

if (!isset($destinationPrices[$destination])) {
    echo json_encode(['ok' => false, 'message' => 'Invalid destination selected.']);
    exit;
}

if (!in_array($paymentMethod, $allowedPayments, true)) {
    echo json_encode(['ok' => false, 'message' => 'Invalid payment method selected.']);
    exit;
}

$totalPrice = $destinationPrices[$destination] * $passengers;
$bookingCode = 'FS-' . strtoupper(bin2hex(random_bytes(3)));

$stmt = $pdo->prepare("
    INSERT INTO bookings
    (booking_code, full_name, email, phone, destination, travel_date, return_date, passengers, payment_method, transaction_ref, total_price)
    VALUES
    (:booking_code, :full_name, :email, :phone, :destination, :travel_date, :return_date, :passengers, :payment_method, :transaction_ref, :total_price)
");

$stmt->execute([
    ':booking_code' => $bookingCode,
    ':full_name' => $fullName,
    ':email' => $email,
    ':phone' => $phone,
    ':destination' => $destination,
    ':travel_date' => $travelDate,
    ':return_date' => $returnDate ?: null,
    ':passengers' => $passengers,
    ':payment_method' => $paymentMethod,
    ':transaction_ref' => $transactionRef,
    ':total_price' => $totalPrice,
]);

echo json_encode(['ok' => true, 'booking_code' => $bookingCode]);
