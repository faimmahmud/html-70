<?php
declare(strict_types=1);

header('Content-Type: application/json');

$pdo = require __DIR__ . '/../config/db.php';

function clean(string $key): string {
    return trim($_POST[$key] ?? '');
}

$name = clean('name');
$email = clean('email');
$subject = clean('subject');
$message = clean('message');

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    echo json_encode(['ok' => false, 'message' => 'Please fill in all fields.']);
    exit;
}

$stmt = $pdo->prepare("
    INSERT INTO contacts (name, email, subject, message)
    VALUES (:name, :email, :subject, :message)
");

$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':subject' => $subject,
    ':message' => $message,
]);

echo json_encode(['ok' => true]);
