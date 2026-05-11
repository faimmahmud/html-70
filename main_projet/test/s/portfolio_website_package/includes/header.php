<?php
$pageTitle = $pageTitle ?? 'Faim — Portfolio';
$pageDescription = $pageDescription ?? 'Premium portfolio website for a full-stack developer, built with HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, and PHP.';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
  <meta name="theme-color" content="#0b0f19">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/images/og-cover.svg">
  <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="page-loader" id="pageLoader"><div class="spinner"></div></div>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav" id="siteNav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Faim<span>.</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='index.php'?'active':''; ?>" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='about.php'?'active':''; ?>" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='projects.php'?'active':''; ?>" href="projects.php">Projects</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='contact.php'?'active':''; ?>" href="contact.php">Contact</a></li>
        <li class="nav-item ms-lg-2"><a class="btn btn-accent btn-sm px-3" href="#contact">Hire Me</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="main-shell">
