<?php
$pageTitle = 'Aurelia Estates | Global Real Estate Marketplace';
$currentPage = 'home';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">Premium global property platform</span>
        <h1 class="fw-black mb-4">Find homes with a calm, modern, Arc-style experience.</h1>
        <p class="lead mb-4">
          Buy, sell, rent, and book visits worldwide through a refined marketplace designed for speed, trust, and luxury.
        </p>

        <div class="surface search-bar mb-4">
          <div class="row g-2">
            <div class="col-md-5">
              <input id="globalSearch" type="text" class="form-control form-control-lg" placeholder="Location, neighborhood, or landmark">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control form-control-lg" placeholder="Price range">
            </div>
            <div class="col-md-2">
              <select class="form-select form-select-lg">
                <option>Property type</option>
                <option>Apartment</option>
                <option>House</option>
                <option>Villa</option>
                <option>Penthouse</option>
              </select>
            </div>
            <div class="col-md-2 d-grid">
              <a href="listings.php" class="btn btn-accent btn-lg">Search</a>
            </div>
          </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
          <a href="listings.php?type=sale" class="btn btn-outline-light rounded-pill px-3">Buy</a>
          <a href="listings.php?type=rent" class="btn btn-outline-light rounded-pill px-3">Rent</a>
          <a href="dashboard-agent.php" class="btn btn-outline-light rounded-pill px-3">Sell</a>
          <a href="property.php?id=101" class="btn btn-outline-light rounded-pill px-3">Book a visit</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-image" style="background-image:url('https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1400&q=80')">
          <div class="overlay">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <span class="badge badge-soft rounded-pill">Featured home</span>
                  <h3 class="mt-3 mb-1">Ocean-view villa in Malibu</h3>
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
        <p class="text-secondary mb-0">High-end homes curated for modern buyers and renters.</p>
      </div>
      <a href="listings.php" class="text-white">View all <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row g-4">
      <?php foreach ($featuredProperties as $property): ?>
      <div class="col-md-4">
        <div class="listing-card h-100">
          <img src="<?php echo $property['image']; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>">
          <div class="body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge badge-soft"><?php echo $property['badge']; ?></span>
              <span class="fw-semibold"><?php echo $property['price']; ?></span>
            </div>
            <h5 class="mb-1"><?php echo htmlspecialchars($property['title']); ?></h5>
            <p class="small-muted mb-2"><?php echo htmlspecialchars($property['location']); ?></p>
            <div class="d-flex justify-content-between text-secondary small">
              <span><?php echo $property['beds']; ?> bd</span>
              <span><?php echo $property['baths']; ?> ba</span>
              <span><?php echo $property['area']; ?></span>
            </div>
            <div class="d-flex gap-2 mt-3">
              <a href="property.php?id=<?php echo $property['id']; ?>" class="btn btn-accent btn-sm flex-grow-1">View details</a>
              <button class="btn btn-outline-light btn-sm" data-save-btn><i class="bi bi-heart"></i></button>
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
          <p class="text-secondary">The most searched cities on the platform.</p>
          <?php foreach ($trendingLocations as $city): ?>
          <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary border-opacity-25">
            <div>
              <div class="fw-semibold"><?php echo htmlspecialchars($city['name']); ?></div>
              <small class="text-secondary"><?php echo htmlspecialchars($city['count']); ?></small>
            </div>
            <i class="bi bi-arrow-up-right-circle fs-4"></i>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="surface h-100">
          <div class="d-flex justify-content-between align-items-end mb-3">
            <div>
              <h3 class="section-title">Why this platform wins</h3>
              <p class="text-secondary mb-0">Designed for trust, conversion, and premium user experience.</p>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="panel-card p-4 h-100">
                <h5>Minimal, premium UI</h5>
                <p class="text-secondary mb-0">Whitespace, elegant cards, sharp typography, and smooth motion.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel-card p-4 h-100">
                <h5>Global marketplace</h5>
                <p class="text-secondary mb-0">Support for multi-currency, multi-language, and location-based search.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel-card p-4 h-100">
                <h5>Agent CRM</h5>
                <p class="text-secondary mb-0">Lead inbox, booking management, analytics, and property publishing tools.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel-card p-4 h-100">
                <h5>Admin controls</h5>
                <p class="text-secondary mb-0">Moderation, audits, permissions, and transaction oversight.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
