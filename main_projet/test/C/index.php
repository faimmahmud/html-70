<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>
<section class="hero">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge badge-soft text-dark mb-3">International Tourism Platform</span>
        <h1>Discover the world in premium style.</h1>
        <p class="lead mt-3">A luxury-inspired tourism website with modern UI, clean navigation, and simple booking flow designed for global travelers.</p>
        <div class="d-flex flex-wrap gap-2 mt-4">
          <a href="tours.php" class="btn btn-light btn-lg px-4">Explore Tours</a>
          <a href="booking.php" class="btn btn-outline-light btn-lg px-4">Book Now</a>
        </div>
      </div>
      <div class="col-lg-5 mt-5 mt-lg-0">
        <div class="card-soft p-4 text-dark">
          <h5 class="fw-bold mb-3">Why travelers choose us</h5>
          <div class="d-flex justify-content-between border-bottom py-2"><span>Luxury experience</span><span>★★★★★</span></div>
          <div class="d-flex justify-content-between border-bottom py-2"><span>Global destinations</span><span>120+</span></div>
          <div class="d-flex justify-content-between py-2"><span>Simple booking</span><span>Fast</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <div class="text-uppercase text-muted small">Featured</div>
        <h2 class="section-title">Popular destinations</h2>
      </div>
      <a href="destinations.php" class="btn btn-outline-dark">View all</a>
    </div>
    <div class="row g-4">
      <?php foreach (array_slice(get_destinations(), 0, 3) as $d): ?>
      <div class="col-md-4">
        <div class="card-soft h-100">
          <img src="<?= esc($d['image']) ?>" alt="<?= esc($d['name']) ?>">
          <div class="p-4">
            <div class="badge badge-soft mb-2"><?= esc($d['type']) ?></div>
            <h5 class="fw-bold"><?= esc($d['name']) ?></h5>
            <p class="text-muted mb-0"><?= esc($d['price']) ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4"><div class="stat"><h4>Luxury</h4><p class="text-muted mb-0">Premium design and travel experience.</p></div></div>
      <div class="col-md-4"><div class="stat"><h4>Reliable</h4><p class="text-muted mb-0">Simple, clear, and user-friendly pages.</p></div></div>
      <div class="col-md-4"><div class="stat"><h4>Global</h4><p class="text-muted mb-0">Built for international tourists worldwide.</p></div></div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
