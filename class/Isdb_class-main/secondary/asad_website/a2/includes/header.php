<?php
require_once __DIR__ . '/bootstrap.php';
if (isset($_GET['lang'])) { set_lang((string)$_GET['lang']); }
$pageTitle = $pageTitle ?? APP_NAME;
$currentPage = $currentPage ?? '';
$user = current_user();
?>
<!doctype html>
<html lang="<?php echo e(lang()); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($pageTitle); ?></title>
  <meta name="description" content="Premium real estate marketplace with property search, agent dashboard, booking, and comparison tools.">
  <meta property="og:title" content="<?php echo e($pageTitle); ?>">
  <meta property="og:description" content="Premium real estate marketplace.">
  <meta property="og:type" content="website">
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#0a0f1e">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark nav-glass sticky-top">
  <div class="container py-2">
    <a class="navbar-brand fw-bold" href="index.php"><span class="brand-mark">A</span>urelia Estates</a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-lg-2">
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='home'?'active':''; ?>" href="index.php"><?php echo e(t('home')); ?></a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='buy'?'active':''; ?>" href="listings.php?listing_type=sale"><?php echo e(t('buy')); ?></a></li>
        <li class="nav-item"><a class="nav-link <?php echo $currentPage==='rent'?'active':''; ?>" href="listings.php?listing_type=rent"><?php echo e(t('rent')); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="compare.php"><?php echo e(t('compare')); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="calculator.php"><?php echo e(t('calculator')); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="admin.php"><?php echo e(t('admin')); ?></a></li>
      </ul>
      <div class="d-flex gap-2 align-items-center">
        <a href="?lang=en" class="btn btn-outline-light btn-sm <?php echo lang()==='en'?'active':''; ?>">EN</a>
        <a href="?lang=bn" class="btn btn-outline-light btn-sm <?php echo lang()==='bn'?'active':''; ?>">BN</a>
        <?php if ($user): ?>
          <a href="dashboard-buyer.php" class="btn btn-outline-light btn-sm px-3"><?php echo e(t('dashboard')); ?></a>
          <a href="logout.php" class="btn btn-accent btn-sm px-3">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light btn-sm px-3"><?php echo e(t('login')); ?></a>
          <a href="login.php#register" class="btn btn-accent btn-sm px-3"><?php echo e(t('list_property')); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<main>
<?php
if ($msg = flash('success')) echo '<div class="container pt-3"><div class="alert alert-success">' . e($msg) . '</div></div>';
if ($msg = flash('error')) echo '<div class="container pt-3"><div class="alert alert-danger">' . e($msg) . '</div></div>';
?>
