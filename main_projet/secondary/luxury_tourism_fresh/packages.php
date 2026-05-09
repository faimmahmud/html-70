<?php $pageTitle = 'Tour Packages | Aurelia Travel'; require_once __DIR__ . '/includes/header.php'; ?>
<section class="section pt-4">
  <div class="container">
    <div class="pack-hero reveal mb-5">
      <div class="pack-media" data-parallax="0.08" style="background-image:url('<?php echo e($featuredTours[3]['image']); ?>')"></div>
      <div class="pack-content">
        <span class="kicker mb-3"><i class="fa-solid fa-suitcase-rolling"></i> Tour Packages</span>
        <h1 class="section-title mb-3">Dynamic packages with a luxury single-view presentation</h1>
        <p class="small-muted mb-4">The entire package catalog loads dynamically and keeps the hero image large, polished, and brand-focused.</p>
        <a href="booking.php" class="btn btn-lux">Open Booking</a>
      </div>
    </div>

    <div id="packagesLoader" class="row g-4"></div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
