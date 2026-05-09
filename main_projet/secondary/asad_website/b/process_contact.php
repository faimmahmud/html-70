<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Demo-only handler. In production, validate, sanitize, and store to DB / send mail.
$success = $name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $subject !== '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Submission</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-soft">
  <div class="container py-5">
    <div class="card border-0 shadow-sm p-4 mx-auto" style="max-width:720px;">
      <?php if ($success): ?>
        <h1 class="fw-bold">Inquiry sent</h1>
        <p class="text-secondary mb-0">Thanks, <?= htmlspecialchars($name) ?>. Your message about "<?= htmlspecialchars($subject) ?>" has been received.</p>
      <?php else: ?>
        <h1 class="fw-bold">Submission failed</h1>
        <p class="text-secondary mb-0">Please go back and make sure the name, email, and subject are valid.</p>
      <?php endif; ?>
      <div class="mt-4">
        <a href="index.php" class="btn btn-accent">Back to site</a>
      </div>
    </div>
  </div>
</body>
</html>
