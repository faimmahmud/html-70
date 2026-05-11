<?php
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/includes/header.php';
?>
<div class="admin-wrap">
  <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
  <main class="admin-content">
    <h1 class="section-title mb-4">Dashboard</h1>
    <div class="row g-4">
      <div class="col-md-4"><div class="stat"><div class="text-muted small">Users</div><div class="fs-3 fw-bold"><?= count($_SESSION['users']) ?></div></div></div>
      <div class="col-md-4"><div class="stat"><div class="text-muted small">Bookings</div><div class="fs-3 fw-bold"><?= count($_SESSION['bookings']) ?></div></div></div>
      <div class="col-md-4"><div class="stat"><div class="text-muted small">Tours</div><div class="fs-3 fw-bold"><?= count(get_tours()) ?></div></div></div>
    </div>
  </main>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
