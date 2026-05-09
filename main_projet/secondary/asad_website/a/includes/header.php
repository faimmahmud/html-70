<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data.php';

$pageTitle = $pageTitle ?? APP_NAME;
$currentPage = $currentPage ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark nav-glass sticky-top">
  <div class="container py-2">
    <a class="navbar-brand fw-bold" href="index.php">
      <span class="brand-mark">A</span>urelia Estates
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-lg-2">
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='buy'?'active':''; ?>" href="listings.php?type=sale">Buy</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='rent'?'active':''; ?>" href="listings.php?type=rent">Rent</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard-agent.php">Sell</a></li>
        <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
      </ul>
      <div class="d-flex gap-2">
        <a href="login.php" class="btn btn-outline-light btn-sm px-3">Login</a>
        <a href="dashboard-agent.php" class="btn btn-accent btn-sm px-3">List Property</a>
      </div>
    </div>
  </div>
</nav>
<main>
