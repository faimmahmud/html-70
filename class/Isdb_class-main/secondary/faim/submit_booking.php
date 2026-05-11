<?php
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$destination = $_POST['destination'] ?? '';
$travel_date = $_POST['travel_date'] ?? '';
$message = $_POST['message'] ?? '';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Sent</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card shadow-sm p-4 mx-auto" style="max-width: 720px;">
    <h2 class="mb-3">Booking request received</h2>
    <p class="text-secondary">Thanks, <?= htmlspecialchars($name) ?>. We received your request for <strong><?= htmlspecialchars($destination) ?></strong>.</p>
    <ul class="list-group mb-3">
      <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
      <li class="list-group-item"><strong>Travel date:</strong> <?= htmlspecialchars($travel_date) ?></li>
      <li class="list-group-item"><strong>Message:</strong> <?= nl2br(htmlspecialchars($message)) ?></li>
    </ul>
    <a class="btn btn-primary" href="index.php">Back to home</a>
  </div>
</div>
</body>
</html>
