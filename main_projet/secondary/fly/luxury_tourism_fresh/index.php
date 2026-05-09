<?php $pageTitle = 'Aurelia Travel | Luxury Tourism'; require_once __DIR__ . '/includes/header.php'; ?>
<?php $slides = $heroSlides; ?>
<section class="hero">
  <div class="hero-media" data-parallax="0.12" style="background-image:url('<?php echo e($slides[0]['image']); ?>')"></div>
  <div class="container position-relative">
    <div class="hero-content reveal">
      <span class="kicker"><i class="fa-solid fa-compass"></i> Premium tourism website • Arc style • Full-screen visuals</span>
      <h1><?php echo e($slides[0]['title']); ?></h1>
      <p><?php echo e($slides[0]['subtitle']); ?></p>
      <div class="search-box mt-4 mb-4">
        <div class="row g-2 align-items-center">
          <div class="col-md-8">
            <input type="text" class="form-control form-control-lg" placeholder="Search destinations like Maldives, Dubai, Switzerland...">
          </div>
          <div class="col-md-4">
            <button class="btn btn-lux w-100 btn-lg"><i class="fa-solid fa-magnifying-glass me-2"></i>Explore Now</button>
          </div>
        </div>
      </div>
      <div class="d-flex flex-wrap gap-3">
        <a href="packages.php" class="btn btn-lux">View Packages</a>
        <a href="destinations.php" class="btn btn-outline-lux">Browse Destinations</a>
      </div>
    </div>
  </div>
</section>

<section class="section arc-top">
  <div class="container">
    <div class="row align-items-end mb-4 gy-3">
      <div class="col-lg-7 reveal">
        <h2 class="section-title mb-3">Featured tours with cinematic visuals</h2>
        <p class="section-sub mb-0">Each package uses a single strong image, luxury spacing, and feature-first layout so the page feels closer to a high-end brand than a standard travel template.</p>
      </div>
      <div class="col-lg-5 text-lg-end reveal">
        <div class="info-row justify-content-lg-end">
          <span class="info-pill"><i class="fa-solid fa-wand-magic-sparkles me-1"></i> Smooth hover</span>
          <span class="info-pill"><i class="fa-solid fa-layer-group me-1"></i> Curved arcs</span>
          <span class="info-pill"><i class="fa-solid fa-mobile-screen me-1"></i> Responsive</span>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <?php foreach (array_slice($featuredTours, 0, 3) as $tour): ?>
      <div class="col-lg-4 reveal">
        <div class="card card-premium h-100">
          <div class="image-cover" style="background-image:url('<?php echo e($tour['image']); ?>')">
            <div class="overlay-content">
              <div class="d-flex justify-content-between align-items-start">
                <span class="badge-soft text-dark"><i class="fa-solid fa-star text-warning"></i> <?php echo e($tour['rating']); ?></span>
                <span class="badge-soft text-dark"><?php echo e($tour['days']); ?></span>
              </div>
              <h4 class="mt-3 mb-1 fw-bold"><?php echo e($tour['title']); ?></h4>
              <p class="mb-0"><?php echo e($tour['location']); ?></p>
            </div>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge text-bg-light border"><?php echo e($tour['tag']); ?></span>
              <span class="fw-bold fs-4"><?php echo e($tour['price']); ?></span>
            </div>
            <p class="small-muted"><?php echo e($tour['desc']); ?></p>
            <a href="booking.php?package=<?php echo (int)$tour['id']; ?>" class="btn btn-lux">Book this trip</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <div class="row g-3">
      <?php foreach ($stats as $stat): ?>
      <div class="col-md-3 col-6 reveal">
        <div class="stat-box text-center">
          <div class="stat-number"><?php echo e($stat['value']); ?></div>
          <div class="text-secondary"><?php echo e($stat['label']); ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row align-items-center mb-4 gy-3">
      <div class="col-lg-8 reveal">
        <h2 class="section-title mb-2">Luxury experiences, modern startup energy</h2>
        <p class="section-sub mb-0">Curved sections, glass surfaces, and a premium motion language make every part of the site feel intentional.</p>
      </div>
    </div>

    <div class="full-screen-panel reveal">
      <div class="panel-media" data-parallax="0.08" style="background-image:url('<?php echo e($slides[1]['image']); ?>')"></div>
      <div class="panel-content">
        <span class="kicker mb-3"><i class="fa-solid fa-location-dot"></i> Curated destinations</span>
        <h3 class="section-title mb-3"><?php echo e($slides[1]['title']); ?></h3>
        <p class="small-muted mb-4"><?php echo e($slides[1]['subtitle']); ?></p>
        <div class="info-row mb-4">
          <span class="info-pill"><i class="fa-solid fa-umbrella-beach me-1"></i> Beach escapes</span>
          <span class="info-pill"><i class="fa-solid fa-mountain-sun me-1"></i> Mountain routes</span>
          <span class="info-pill"><i class="fa-solid fa-city me-1"></i> City breaks</span>
        </div>
        <a href="destinations.php" class="btn btn-lux">Open Destinations</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-5 reveal">
        <div class="testimonial-item h-100">
          <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;"><i class="fa-solid fa-comment-dots fs-4 text-primary"></i></div>
            <div>
              <h5 class="mb-0">What travelers say</h5>
              <small class="text-secondary">Luxury-first UI feedback</small>
            </div>
          </div>
          <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php foreach ($testimonials as $i => $t): ?>
              <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                <p class="lead mb-3">“<?php echo e($t['text']); ?>”</p>
                <div class="fw-semibold"><?php echo e($t['name']); ?></div>
                <div class="text-secondary small"><?php echo e($t['role']); ?></div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 reveal">
        <div class="full-screen-panel">
          <div class="panel-media" data-parallax="0.06" style="background-image:url('<?php echo e($slides[2]['image']); ?>')"></div>
          <div class="panel-content">
            <span class="kicker mb-3"><i class="fa-solid fa-sparkles"></i> Premium presentation</span>
            <h3 class="section-title mb-3"><?php echo e($slides[2]['title']); ?></h3>
            <p class="small-muted mb-4"><?php echo e($slides[2]['subtitle']); ?></p>
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="glass-card p-3 rounded-4">
                  <div class="fw-bold mb-1">Animated hover states</div>
                  <div class="text-secondary small">Cards and buttons react smoothly with motion and depth.</div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="glass-card p-3 rounded-4">
                  <div class="fw-bold mb-1">Feature-rich layouts</div>
                  <div class="text-secondary small">Each section keeps image and benefits visible at the same time.</div>
                </div>
              </div>
            </div>
            <a href="booking.php" class="btn btn-lux">Start Booking</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
