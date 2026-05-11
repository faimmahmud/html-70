<?php
$pageTitle = 'Aurelia Estates | Premium Real Estate Marketplace';
$currentPage = 'home';
require_once __DIR__ . '/includes/header.php';
$featuredProperties = get_featured_properties();
$trendingLocations = get_trending_locations();
?>
<section class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">Premium property platform</span>
        <h1 class="mb-4">Find homes with a calm, modern, premium experience.</h1>
        <p class="lead mb-4">Search listings, save favorites, compare properties, book tours, and manage leads in one place.</p>

        <div class="surface search-bar mb-4 position-relative">
          <div class="row g-2 align-items-center">
            <div class="col-md-6 position-relative">
              <input id="ajaxSearch" type="text" class="form-control form-control-lg" placeholder="Location, city, or property name">
              <div id="suggestions" class="dropdown-menu w-100 d-none position-absolute mt-1 shadow-lg"></div>
            </div>
            <div class="col-md-3">
              <select class="form-select form-select-lg">
                <option>Property type</option>
                <option>Apartment</option>
                <option>House</option>
                <option>Penthouse</option>
                <option>Condo</option>
              </select>
            </div>
            <div class="col-md-3 d-grid">
              <a href="listings.php" class="btn btn-accent btn-lg"><?php echo e(t('search')); ?></a>
            </div>
          </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
          <a href="listings.php?listing_type=sale" class="btn btn-outline-light rounded-pill px-3">Buy</a>
          <a href="listings.php?listing_type=rent" class="btn btn-outline-light rounded-pill px-3">Rent</a>
          <a href="dashboard-agent.php" class="btn btn-outline-light rounded-pill px-3">Sell</a>
          <a href="calculator.php" class="btn btn-outline-light rounded-pill px-3">EMI Calculator</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-image" style="background-image:url('https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1400&q=80')">
          <div class="overlay">
            <div class="surface soft p-4">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <span class="badge badge-soft rounded-pill">Featured home</span>
                  <h3 class="mt-3 mb-1">Ocean-view villa</h3>
                  <p class="mb-0 text-secondary">6 beds · 7 baths · 7,200 sqft</p>
                </div>
                <div class="text-end">
                  <div class="h4 mb-0">$8.9M</div>
                  <small class="text-secondary">Starting price</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-3">
      <div>
        <h2 class="section-title">Featured listings</h2>
        <p class="text-secondary mb-0">Premium homes with booking, inquiry, and compare actions.</p>
      </div>
      <a href="listings.php" class="text-white">View all <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row g-4">
      <?php foreach ($featuredProperties as $property): ?>
      <div class="col-md-4">
        <div class="listing-card h-100">
          <img src="<?php echo e($property['image']); ?>" alt="<?php echo e($property['title']); ?>">
          <div class="body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge badge-soft"><?php echo e($property['status'] ?? 'live'); ?></span>
              <span class="fw-semibold"><?php echo e(money($property['price'])); ?></span>
            </div>
            <h5 class="mb-1"><?php echo e($property['title']); ?></h5>
            <p class="small-muted mb-2"><?php echo e($property['city']); ?>, <?php echo e($property['country']); ?></p>
            <div class="d-flex justify-content-between text-secondary small">
              <span><?php echo (int)$property['bedrooms']; ?> bd</span>
              <span><?php echo (int)$property['bathrooms']; ?> ba</span>
              <span><?php echo e(number_format((int)$property['area_sqft'])); ?> sqft</span>
            </div>
            <div class="d-flex gap-2 mt-3">
              <a href="property.php?id=<?php echo e($property['id']); ?>" class="btn btn-accent btn-sm flex-grow-1">View details</a>
              <button class="btn btn-outline-light btn-sm wishlist-btn" data-id="<?php echo e($property['id']); ?>"><i class="bi bi-heart"></i></button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-4">
        <div class="surface h-100">
          <h3 class="section-title">Trending locations</h3>
          <p class="text-secondary">Most searched cities on the platform.</p>
          <?php foreach ($trendingLocations as $city): ?>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary border-opacity-25">
            <div>
              <div class="fw-semibold"><?php echo e($city['name']); ?></div>
              <small class="text-secondary"><?php echo e($city['count']); ?></small>
            </div>
            <i class="bi bi-arrow-up-right-circle fs-4"></i>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="surface h-100">
          <h3 class="section-title mb-3">Built for trust, speed, and premium feel</h3>
          <div class="row g-3">
            <div class="col-md-6"><div class="panel-card h-100"><h5>Search engine</h5><p class="text-secondary mb-0">Multi-filter search, AJAX suggestions, and SEO-friendly paths.</p></div></div>
            <div class="col-md-6"><div class="panel-card h-100"><h5>Buyer tools</h5><p class="text-secondary mb-0">Wishlist, inquiries, bookings, and recently viewed properties.</p></div></div>
            <div class="col-md-6"><div class="panel-card h-100"><h5>Agent workspace</h5><p class="text-secondary mb-0">Property management, lead tracking, and booking control.</p></div></div>
            <div class="col-md-6"><div class="panel-card h-100"><h5>Admin control</h5><p class="text-secondary mb-0">Approval workflow, rates, users, analytics, and audit logs.</p></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
