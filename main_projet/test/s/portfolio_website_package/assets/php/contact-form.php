<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../contact.php?error=1');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../../contact.php?error=1');
    exit;
}

$to = 'hello@yourdomain.com';
$body = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}\n";
$headers = "From: {$name} <{$email}>\r\nReply-To: {$email}\r\n";

@mail($to, $subject, $body, $headers);

header('Location: ../../contact.php?success=1');
exit;
