<?php
$pageTitle = 'About';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<div class="container py-5">
  <div class="row g-4 align-items-center">
    <div class="col-lg-6">
      <h1 class="section-title">About Terra Vista</h1>
      <p class="text-muted">A premium tourism website concept created for international travelers. The layout stays clean, readable, and elegant across devices.</p>
      <p class="text-muted">This version uses no database, so it is easier to run and test locally.</p>
    </div>
    <div class="col-lg-6">
      <div class="card-soft p-4">
        <h5 class="fw-bold">What it includes</h5>
        <ul class="mb-0">
          <li>Home, tours, destinations, blog, contact</li>
          <li>Login, register, dashboard, booking</li>
          <li>Admin pages and responsive layout</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
