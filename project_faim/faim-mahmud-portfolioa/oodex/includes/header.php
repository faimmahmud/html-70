<?php
declare(strict_types=1);

$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? SITE_TAGLINE;
$activePage = $activePage ?? 'home';
$isHome = $activePage === 'home';
$homePrefix = $isHome ? '' : 'index.php';
$homeHref = $isHome ? '#top' : 'index.php#top';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($pageDescription); ?>">
    <meta name="keywords" content="faim mahmud, web developer, PHP developer, Bootstrap developer, JavaScript developer, luxury portfolio">
    <meta name="author" content="faim mahmud">
    <meta name="theme-color" content="#050505">
    <meta property="og:title" content="<?= e($pageTitle); ?>">
    <meta property="og:description" content="<?= e($pageDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= e(asset('images/royaltexture.webp')); ?>">
    <title><?= e($pageTitle); ?></title>
    <link rel="preload" href="<?= e(asset('images/royaltexture.webp')); ?>" as="image">
    <link rel="stylesheet" href="<?= e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="grain" aria-hidden="true"></div>
    <div class="cursor-aura" aria-hidden="true"></div>

    <a class="skip-link" href="#main">Skip to content</a>

    <header class="site-header" data-header>
        <nav class="navbar navbar-expand-lg" aria-label="Primary navigation">
            <div class="container-fluid px-3 px-lg-5">
                <a class="brand-mark" href="index.php#top" aria-label="faim mahmud home">
                    <span class="brand-orbit"></span>
                    <span>faim mahmud</span>
                </a>

                <a class="mobile-brief-link" href="index.php#contact">Brief</a>

                <button class="navbar-toggler nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                    <ul class="navbar-nav align-items-lg-center gap-lg-2">
                        <li class="nav-item"><a class="nav-link<?= $activePage === 'home' ? ' active' : ''; ?>" href="<?= e($homeHref); ?>"<?= $isHome ? ' data-section-link' : ''; ?>>Home</a></li>
                        <li class="nav-item"><a class="nav-link<?= $activePage === 'capability' ? ' active' : ''; ?>" href="capability-lab.php">Capability Lab</a></li>
                        <li class="nav-item"><a class="nav-link<?= $activePage === 'all' ? ' active' : ''; ?>" href="all.php">All</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= e($homePrefix); ?>#work"<?= $isHome ? ' data-section-link' : ''; ?>>Work</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= e($homePrefix); ?>#process"<?= $isHome ? ' data-section-link' : ''; ?>>Process</a></li>
                        <li class="nav-item"><a class="nav-link nav-cta magnetic" href="<?= e($homePrefix); ?>#contact"<?= $isHome ? ' data-section-link' : ''; ?>>Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
