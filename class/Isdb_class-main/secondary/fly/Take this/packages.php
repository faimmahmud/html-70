<?php
$pageTitle = 'Packages | Fly Soul';
$pageDescription = 'Premium travel offers and special package deals.';
$activePage = 'packages';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">Packages & deals</div>
    <h1 class="section-title mb-2">Exclusive offers for you</h1>
    <p class="mb-0">Travel packages inspired by the same destinations and visuals across the site.</p>
  </div>
</section>

<section class="container py-4 py-lg-5">
  <div class="offer-grid">
    <?php foreach ($offers as $offer): ?>
      <div class="offer-tile">
        <div class="bg" style="background-image:url('<?= htmlspecialchars($offer['image']) ?>')"></div>
        <div class="meta">
          <div><span class="badge-blue"><?= htmlspecialchars($offer['tag']) ?></span></div>
          <div>
            <h3><?= htmlspecialchars($offer['title']) ?></h3>
            <p><?= htmlspecialchars($offer['text']) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="container pb-5">
  <div class="row g-4">
    <?php foreach ($destinations as $d): ?>
      <div class="col-md-6 col-lg-4">
        <div class="destination-card h-100">
          <div class="destination-photo"><img src="<?= htmlspecialchars($d['image']) ?>" alt="<?= htmlspecialchars($d['name']) ?>"></div>
          <div class="destination-body">
            <h5 class="mb-1"><?= htmlspecialchars($d['name']) ?></h5>
            <div class="mini-text mb-2"><?= htmlspecialchars($d['country']) ?></div>
            <div class="price">from BDT <?= number_format($d['price']) ?>*</div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
