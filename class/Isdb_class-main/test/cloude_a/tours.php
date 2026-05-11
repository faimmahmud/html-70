<?php
$pageTitle = 'Tours';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
$tours = get_tours();
?>
<div class="container py-5">
  <div class="mb-4">
    <h1 class="section-title">Tours</h1>
    <p class="text-muted">Luxury itineraries with clear details and clean presentation.</p>
  </div>
  <div class="row g-4">
    <?php foreach ($tours as $tour): ?>
    <div class="col-md-6">
      <div class="card-soft p-4 h-100">
        <div class="d-flex justify-content-between align-items-start gap-3">
          <div>
            <h5 class="fw-bold mb-2"><?= esc($tour['title']) ?></h5>
            <p class="text-muted mb-3"><?= esc($tour['desc']) ?></p>
          </div>
          <span class="badge text-bg-dark"><?= esc($tour['rating']) ?></span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="small text-muted">Duration</div>
            <div class="fw-semibold"><?= esc($tour['duration']) ?></div>
          </div>
          <div>
            <div class="small text-muted">Price</div>
            <div class="fw-semibold"><?= esc($tour['price']) ?></div>
          </div>
          <a href="tour-detail.php?id=<?= urlencode($tour['id']) ?>" class="btn btn-dark">Details</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
