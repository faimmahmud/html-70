<?php
$pageTitle = 'Destinations | Fly Soul';
$pageDescription = 'Explore the most popular destinations from Dhaka.';
$activePage = 'home';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';

$region = $_GET['region'] ?? '';
$filtered = array_values(array_filter($destinations, function ($d) use ($region) {
    if ($region === '' || $region === 'Any destination') return true;
    return stripos($d['region'], $region) !== false;
}));
?>

<section class="inner-hero">
  <div class="container">
    <div class="row align-items-end g-3">
      <div class="col-lg-8">
        <div class="section-pill mb-3">Destinations</div>
        <h1 class="section-title mb-2">Popular destinations</h1>
        <p class="mb-0">Browse the same travel look and feel across every destination card.</p>
      </div>
      <div class="col-lg-4">
        <form class="panel-card p-3 bg-white text-dark" method="get">
          <label class="form-label small text-muted">Filter by region</label>
          <select name="region" class="form-select mb-2">
            <option value="">Any destination</option>
            <option <?= $region==='Europe' ? 'selected' : '' ?>>Europe</option>
            <option <?= $region==='Middle East' ? 'selected' : '' ?>>Middle East</option>
            <option <?= $region==='Asia' ? 'selected' : '' ?>>Asia</option>
            <option <?= $region==='Asia/Europe' ? 'selected' : '' ?>>Asia/Europe</option>
          </select>
          <button class="btn btn-signup w-100">Filter</button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="container py-4 py-lg-5">
  <div class="row g-4">
    <?php foreach ($filtered as $d): ?>
      <div class="col-md-6 col-lg-4">
        <div class="destination-card h-100">
          <div class="destination-photo">
            <img src="<?= htmlspecialchars($d['image']) ?>" alt="<?= htmlspecialchars($d['name']) ?>">
          </div>
          <div class="destination-body">
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
              <div>
                <h5 class="mb-1"><?= htmlspecialchars($d['name']) ?></h5>
                <div class="mini-text"><?= htmlspecialchars($d['country']) ?></div>
              </div>
              <span class="pill"><?= htmlspecialchars($d['badge']) ?></span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="mini-text">Economy return</span>
              <strong class="price">from BDT <?= number_format($d['price']) ?>*</strong>
            </div>
            <a href="booking.php?destination=<?= urlencode($d['name']) ?>" class="btn btn-signup w-100 mt-3">Book now</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
