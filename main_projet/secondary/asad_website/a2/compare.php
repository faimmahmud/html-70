<?php
$pageTitle = 'Compare Properties | Aurelia Estates';
require_once __DIR__ . '/includes/header.php';
$ids = array_filter(array_map('trim', explode(',', (string)($_GET['ids'] ?? '101,102,104'))));
$items = [];
foreach ($ids as $id) {
    $p = get_property($id);
    if ($p) $items[] = $p;
}
if (!$items) $items = array_slice(get_properties([]), 0, 3);
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Comparison</span>
        <h1 class="section-title mt-2">Side-by-side property comparison</h1>
      </div>
      <a href="listings.php" class="btn btn-outline-light">Add more properties</a>
    </div>

    <div class="row g-4">
      <?php foreach ($items as $item): ?>
      <div class="col-md-<?php echo count($items) === 1 ? 12 : 4; ?>">
        <div class="listing-card h-100">
          <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>">
          <div class="body">
            <h5><?php echo e($item['title']); ?></h5>
            <p class="text-secondary mb-2"><?php echo e($item['city']); ?></p>
            <div class="glow-line mb-3"></div>
            <div class="small text-secondary">Price</div><div class="fw-bold mb-2"><?php echo e(money($item['price'])); ?></div>
            <div class="small text-secondary">Beds</div><div class="fw-bold mb-2"><?php echo (int)$item['bedrooms']; ?></div>
            <div class="small text-secondary">Baths</div><div class="fw-bold mb-2"><?php echo (int)$item['bathrooms']; ?></div>
            <div class="small text-secondary">Area</div><div class="fw-bold mb-2"><?php echo e(number_format((int)$item['area_sqft'])); ?> sqft</div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
