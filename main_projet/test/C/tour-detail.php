<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
$id = $_GET['id'] ?? null;
$tour = $id ? get_tour_by_id($id) : null;
$pageTitle = $tour ? $tour['title'] : 'Tour Details';
?>
<div class="container py-5">
  <?php if (!$tour): ?>
    <div class="alert alert-dark">Tour not found.</div>
  <?php else: ?>
    <div class="card-soft p-4">
      <h1 class="section-title"><?= esc($tour['title']) ?></h1>
      <p class="text-muted"><?= esc($tour['desc']) ?></p>
      <div class="row g-3 mt-3">
        <div class="col-md-4"><div class="stat"><div class="text-muted small">Duration</div><div class="fw-bold"><?= esc($tour['duration']) ?></div></div></div>
        <div class="col-md-4"><div class="stat"><div class="text-muted small">Rating</div><div class="fw-bold"><?= esc($tour['rating']) ?></div></div></div>
        <div class="col-md-4"><div class="stat"><div class="text-muted small">Price</div><div class="fw-bold"><?= esc($tour['price']) ?></div></div></div>
      </div>
      <div class="mt-4">
        <a class="btn btn-dark" href="booking.php">Book this tour</a>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
