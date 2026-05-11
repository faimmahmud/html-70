<?php
if (!isset($pageTitle)) $pageTitle = 'Fly Soul';
if (!isset($pageDescription)) $pageDescription = 'Premium travel booking platform.';
$activePage = $activePage ?? '';
function nav_active(string $slug, string $activePage): string {
    return $slug === $activePage ? 'active' : '';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="theme-color" content="#0b1530">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="top-nav">
  <div class="container d-flex justify-content-between align-items-center py-3 small text-white-50">
    <div class="d-flex align-items-center gap-2">
      <span class="brand-mark">✈</span>
      <span>Discover the world</span>
    </div>
    <div class="d-flex align-items-center gap-3">
      <span>BDT</span>
      <span class="d-none d-sm-inline">24/7 Support</span>
      <a class="text-white-50" href="contact.php">Log in</a>
      <a class="btn btn-signup" href="contact.php">Sign up</a>
    </div>
  </div>
  <nav class="navbar navbar-expand-xl navbar-dark py-0">
    <div class="container">
      <a class="navbar-brand fw-bold fs-3" href="index.php">Fly Soul ✈</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto gap-xl-2">
          <li class="nav-item"><a class="nav-link <?= nav_active('home', $activePage) ?>" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('flights', $activePage) ?>" href="booking.php">Flights</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('hotels', $activePage) ?>" href="services.php?type=hotels">Hotels</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('experiences', $activePage) ?>" href="services.php?type=tours">Experiences</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('packages', $activePage) ?>" href="packages.php">Packages</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('deals', $activePage) ?>" href="packages.php">Deals</a></li>
          <li class="nav-item"><a class="nav-link <?= nav_active('support', $activePage) ?>" href="contact.php">Support</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3">
          <a class="nav-link text-white-50 px-0" href="contact.php">💼</a>
          <a class="btn btn-signup px-4" href="contact.php">Sign up</a>
        </div>
      </div>
    </div>
  </nav>
</header>
<main>
