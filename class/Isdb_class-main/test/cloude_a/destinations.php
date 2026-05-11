<?php
$pageTitle = 'Destinations';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
$items = get_destinations();
?>
<div class="container py-5">
  <div class="mb-4">
    <h1 class="section-title">Destinations</h1>
    <p class="text-muted">Curated locations for premium international travelers.</p>
  </div>
  <div class="row g-4">
    <?php foreach ($items as $item): ?>
    <div class="col-md-6 col-lg-3">
      <div class="card-soft h-100">
        <img src="<?= esc($item['image']) ?>" alt="<?= esc($item['name']) ?>">
        <div class="p-3">
          <div class="badge badge-soft mb-2"><?= esc($item['type']) ?></div>
          <h5 class="fw-bold mb-1"><?= esc($item['name']) ?></h5>
          <div class="text-muted"><?= esc($item['price']) ?></div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
