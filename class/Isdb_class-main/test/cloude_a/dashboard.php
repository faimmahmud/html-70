<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
require_login('login.php');
$user = current_user();
?>
<div class="container py-5">
  <h1 class="section-title mb-4">Dashboard</h1>
  <div class="row g-4">
    <div class="col-lg-4"><div class="stat"><div class="text-muted small">Welcome</div><div class="fs-4 fw-bold"><?= esc($user['name'] ?? '') ?></div></div></div>
    <div class="col-lg-4"><div class="stat"><div class="text-muted small">Email</div><div class="fw-bold"><?= esc($user['email'] ?? '') ?></div></div></div>
    <div class="col-lg-4"><div class="stat"><div class="text-muted small">Role</div><div class="fw-bold text-capitalize"><?= esc($user['role'] ?? 'user') ?></div></div></div>
  </div>
  <div class="card-soft p-4 mt-4">
    <h5 class="fw-bold">Your travel area</h5>
    <p class="text-muted mb-0">Use booking to create a request and view it here on the same device session.</p>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
