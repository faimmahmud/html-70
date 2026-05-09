<?php $pageTitle = 'World Countries | Aurelia Travel'; require_once __DIR__ . '/includes/header.php'; ?>
<section class="section pt-4">
  <div class="container">
    <div class="full-screen-panel reveal mb-5">
      <div class="panel-media" data-parallax="0.08" style="background-image:url('<?php echo e($featuredTours[1]['image']); ?>')"></div>
      <div class="panel-content">
        <span class="kicker mb-3"><i class="fa-solid fa-globe"></i> World countries</span>
        <h1 class="section-title mb-3">A country explorer with image-first storytelling</h1>
        <p class="small-muted mb-4">All countries are listed below with large travel imagery and a premium, full-screen feel inspired by luxury product sites.</p>
      </div>
    </div>

    <div class="row g-4">
      <?php foreach (countries_all() as $i => $c): ?>
      <div class="col-lg-3 col-md-4 col-6 reveal" data-cat="<?php echo e($i % 4 === 0 ? 'Europe' : ($i % 4 === 1 ? 'Asia' : ($i % 4 === 2 ? 'Africa' : 'Americas'))); ?>">
        <div class="country-card h-100">
          <img src="<?php echo e($c['image']); ?>" alt="<?php echo e($c['name']); ?>" class="w-100">
          <div class="p-3">
            <div class="d-flex justify-content-between gap-2">
              <h6 class="fw-bold mb-1"><?php echo e($c['name']); ?></h6>
              <span class="badge text-bg-light border"><?php echo e($c['region']); ?></span>
            </div>
            <p class="small-muted mb-0"><?php echo e($c['blurb']); ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
