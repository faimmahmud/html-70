<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Only POST requests are accepted.']);
    exit;
}

$input = [
    'csrf_token' => $_POST['csrf_token'] ?? '',
    'name' => trim((string) ($_POST['name'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'phone' => trim((string) ($_POST['phone'] ?? '')),
    'service' => trim((string) ($_POST['service'] ?? '')),
    'budget' => trim((string) ($_POST['budget'] ?? '')),
    'message' => trim((string) ($_POST['message'] ?? '')),
    'source_page' => trim((string) ($_POST['source_page'] ?? 'portfolio')),
];

$errors = [];

if (!verify_csrf($input['csrf_token'])) {
    $errors['form'] = 'Security check failed. Refresh the page and try again.';
}

if (strlen($input['name']) < 2) {
    $errors['name'] = 'Enter your name.';
}

if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Enter a valid email address.';
}

if ($input['service'] === '') {
    $errors['service'] = 'Choose a service.';
}

if ($input['budget'] === '') {
    $errors['budget'] = 'Choose a budget range.';
}

if (strlen($input['message']) < 20) {
    $errors['message'] = 'Write at least 20 characters about the project.';
}

if ($errors !== []) {
    http_response_code(422);
    echo json_encode([
        'ok' => false,
        'message' => 'Please fix the highlighted details.',
        'errors' => $errors,
    ]);
    exit;
}

try {
    $statement = db()->prepare(
        'INSERT INTO contact_messages
            (name, email, phone, service, budget, message, source_page, ip_address, user_agent)
         VALUES
            (:name, :email, :phone, :service, :budget, :message, :source_page, :ip_address, :user_agent)'
    );

    $statement->execute([
        ':name' => $input['name'],
        ':email' => $input['email'],
        ':phone' => $input['phone'] !== '' ? $input['phone'] : null,
        ':service' => $input['service'],
        ':budget' => $input['budget'],
        ':message' => $input['message'],
        ':source_page' => $input['source_page'],
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    ]);

    echo json_encode([
        'ok' => true,
        'message' => 'Your brief has been received. I will review it with care.',
    ]);
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    http_response_code(503);
    echo json_encode([
        'ok' => false,
        'message' => 'The database is not ready yet. Import database/database.sql in phpMyAdmin, then try again.',
    ]);
}
