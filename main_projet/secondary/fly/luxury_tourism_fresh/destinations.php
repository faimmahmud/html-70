<?php $pageTitle = 'Destinations | Aurelia Travel'; require_once __DIR__ . '/includes/header.php'; ?>
<section class="section pt-4">
  <div class="container">
    <div class="full-screen-panel reveal mb-5">
      <div class="panel-media" data-parallax="0.1" style="background-image:url('<?php echo e($destinations[0]['image']); ?>')"></div>
      <div class="panel-content">
        <span class="kicker mb-3"><i class="fa-solid fa-plane-departure"></i> Destinations</span>
        <h1 class="section-title mb-3">A destination page with an Emirates-style premium feel</h1>
        <p class="small-muted mb-4">Strong imagery, subtle motion, and clear feature blocks make the page feel more like a luxury campaign than a basic travel list.</p>
        <div class="info-row mb-4">
          <span class="info-pill">Live motion</span>
          <span class="info-pill">Luxury branding</span>
          <span class="info-pill">Smart filters</span>
        </div>
        <a href="#destGrid" class="btn btn-lux">Explore</a>
      </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-4 reveal">
      <button class="filter-chip active" data-filter="all">All</button>
      <button class="filter-chip" data-filter="Beach">Beach</button>
      <button class="filter-chip" data-filter="Mountain">Mountain</button>
      <button class="filter-chip" data-filter="City">City</button>
      <button class="filter-chip" data-filter="Island">Island</button>
    </div>

    <div id="destGrid" class="row g-4">
      <?php foreach ($destinations as $i => $d): 
        $cat = $i % 4 === 0 ? 'Beach' : ($i % 4 === 1 ? 'Mountain' : ($i % 4 === 2 ? 'City' : 'Island'));
      ?>
      <div class="col-lg-4 col-md-6 reveal" data-cat="<?php echo e($cat); ?>">
        <div class="country-card h-100">
          <img src="<?php echo e($d['image']); ?>" alt="<?php echo e($d['name']); ?>" class="w-100">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge text-bg-light border"><?php echo e($cat); ?></span>
              <span class="small text-secondary"><?php echo e($d['subtitle']); ?></span>
            </div>
            <h4 class="fw-bold"><?php echo e($d['name']); ?></h4>
            <p class="small-muted mb-4">A curated travel experience styled with a premium visual hierarchy and simple booking flow.</p>
            <a href="packages.php" class="btn btn-lux">View Packages</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
