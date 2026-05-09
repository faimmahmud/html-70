<?php require_once __DIR__ . '/functions.php'; require_once __DIR__ . '/data.php'; $flash = flash_get(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($pageTitle) ? e($pageTitle) : 'Aurelia Travel'; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="cursor-dot"></div>
<div class="cursor-ring"></div>
<nav class="navbar navbar-expand-lg navbar-light sticky-top nav-glass">
  <div class="container py-2">
    <a class="navbar-brand fw-bold" href="index.php">Aurelia <span>Travel</span></a>
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
        <li class="nav-item"><a class="nav-link" href="packages.php">Tour Packages</a></li>
        <li class="nav-item"><a class="nav-link" href="world.php">World Countries</a></li>
        <li class="nav-item"><a class="nav-link" href="booking.php">Booking</a></li>
        <?php if (is_logged_in()): ?>
          <?php if (is_admin()): ?><li class="nav-item"><a class="nav-link" href="admin.php">Admin Panel</a></li><?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php if ($flash): ?>
<div class="container mt-3"><div class="alert alert-<?php echo e($flash['type']); ?> shadow-sm"><?php echo e($flash['msg']); ?></div></div>
<?php endif; ?>
