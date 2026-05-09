<?php
$pageTitle = 'Fly Soul | Premium Travel Booking';
$pageDescription = 'Travel beyond limits with Fly Soul.';
$activePage = 'home';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>

<section class="hero-shell">
  <div class="container py-5 py-lg-4">
    <div class="row align-items-center g-4 g-lg-5 pt-4 pt-lg-5">
      <div class="col-lg-7">
        <div class="hero-kicker mb-3">DISCOVER THE WORLD</div>
        <h1 class="hero-title mb-3">Travel beyond limits with Fly Soul</h1>
        <p class="hero-copy mb-4">Explore amazing destinations, book flights, hotels and experiences — all in one place.</p>
        <div class="hero-points mb-4">
          <div class="hero-point"><span>✔</span><span>Best Price Guarantee</span></div>
          <div class="hero-point"><span>⟳</span><span>24/7 Support</span></div>
          <div class="hero-point"><span>🛡</span><span>Secure Booking</span></div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="offer-card shadow-lg">
          <div class="offer-image" style="background-image:url('assets/img/europe-special.jpg')"></div>
          <div class="content">
            <div>
              <span class="offer-tag">LIMITED TIME OFFER</span>
              <div class="mt-3 fs-5">Summer Getaway Sale</div>
              <h2 class="display-6 fw-bold mb-2">Save up to 25%</h2>
              <p class="mb-3">On selected flights &amp; hotel packages</p>
              <a href="packages.php" class="btn btn-signup px-4">Explore Offers</a>
            </div>
            <div class="count-grid mt-4">
              <div class="count-box"><strong>02</strong><span>Days</span></div>
              <div class="count-box"><strong>14</strong><span>Hours</span></div>
              <div class="count-box"><strong>36</strong><span>Mins</span></div>
              <div class="count-box"><strong>28</strong><span>Secs</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container search-panel mb-4">
  <div class="search-tabs">
    <div class="row g-0 text-center">
      <div class="col-auto col-md"><button class="search-tab active" type="button">Flights</button></div>
      <div class="col-auto col-md"><button class="search-tab" type="button">Hotels</button></div>
      <div class="col-auto col-md"><button class="search-tab" type="button">Tours &amp; Activities</button></div>
      <div class="col-auto col-md"><button class="search-tab" type="button">Chauffeur-drive</button></div>
      <div class="col-auto col-md"><button class="search-tab" type="button">Meet &amp; Greet</button></div>
      <div class="col-auto col-md"><button class="search-tab" type="button">Airport Transfers</button></div>
    </div>
  </div>
  <div class="search-form">
    <form action="booking.php" method="get" class="row g-3 align-items-stretch">
      <div class="col-md-6 col-lg-2">
        <div class="search-field h-100">
          <label>From</label>
          <input type="text" name="from" value="Dhaka (DAC)">
        </div>
      </div>
      <div class="col-md-6 col-lg-2">
        <div class="search-field h-100">
          <label>To</label>
          <input type="text" name="to" placeholder="Where to?">
        </div>
      </div>
      <div class="col-md-6 col-lg-2">
        <div class="search-field h-100">
          <label>Depart</label>
          <input type="date" name="depart" value="2025-05-20">
        </div>
      </div>
      <div class="col-md-6 col-lg-2">
        <div class="search-field h-100">
          <label>Return</label>
          <input type="date" name="return" value="2025-05-27">
        </div>
      </div>
      <div class="col-md-6 col-lg-2">
        <div class="search-field h-100">
          <label>Travelers</label>
          <select name="travelers">
            <option>1 Adult, Economy</option>
            <option>2 Adults, Economy</option>
            <option>1 Adult, Business</option>
          </select>
        </div>
      </div>
      <div class="col-md-6 col-lg-2">
        <button class="search-btn w-100">Search Flights</button>
      </div>
    </form>
    <div class="search-actions">
      <a href="#">Advanced Search</a>
      <div class="small text-muted">Multi-city, Promo codes, Partner airlines</div>
    </div>
  </div>
</section>

<section class="container mb-4">
  <div class="section-card">
    <div class="row g-3">
      <?php foreach ($services as $service): ?>
        <div class="col-6 col-md-4 col-lg-2">
          <a href="services.php?type=<?= urlencode($service['type']) ?>" class="text-dark">
            <div class="service-mini h-100">
              <div class="icon"><?= $service['icon'] ?></div>
              <div>
                <div class="fw-bold"><?= htmlspecialchars($service['title']) ?></div>
                <div class="mini-text"><?= htmlspecialchars($service['subtitle']) ?></div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="container py-2 py-lg-3">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <div class="section-title mb-1">Popular destinations from Dhaka</div>
    </div>
    <a href="destinations.php" class="fw-bold text-decoration-none">View all destinations →</a>
  </div>
  <div class="row g-3 g-lg-4 align-items-stretch">
    <div class="col-lg-9">
      <div class="row row-cols-2 row-cols-lg-5 g-3 g-lg-4">
        <?php foreach ($destinations as $destination): ?>
          <div class="col">
            <div class="destination-card h-100">
              <div class="destination-photo">
                <img src="<?= htmlspecialchars($destination['image']) ?>" alt="<?= htmlspecialchars($destination['name']) ?>">
              </div>
              <div class="destination-body">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                  <div>
                    <h5 class="mb-1"><?= htmlspecialchars($destination['name']) ?></h5>
                    <div class="mini-text"><?= htmlspecialchars($destination['country']) ?></div>
                  </div>
                  <span class="pill"><?= htmlspecialchars($destination['badge']) ?></span>
                </div>
                <div class="price small">from BDT <?= number_format($destination['price']) ?>*</div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="why-card">
        <div class="quote">“</div>
        <div class="fw-semibold fs-5 mb-3">Why travelers choose Fly Soul</div>
        <p class="mb-4">Booking with Fly Soul is so smooth and reliable. Got the best deals and amazing support!</p>
        <div class="d-flex align-items-center gap-3">
          <img class="avatar" src="assets/img/avatar.jpg" alt="Traveler">
          <div>
            <div class="fw-bold">Rahim Hasan</div>
            <div class="small text-white-50">Traveler</div>
          </div>
        </div>
        <div class="mt-3">★★★★★</div>
        <div class="dots"><span class="active"></span><span></span><span></span></div>
      </div>
    </div>
  </div>
</section>

<section class="container py-4 py-lg-5">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <div class="section-title mb-1">Exclusive offers for you</div>
    </div>
    <a href="packages.php" class="fw-bold text-decoration-none">View all offers →</a>
  </div>
  <div class="offer-grid">
    <?php foreach ($offers as $offer): ?>
      <div class="offer-tile">
        <div class="bg" style="background-image:url('<?= htmlspecialchars($offer['image']) ?>')"></div>
        <div class="meta">
          <div><span class="badge-red"><?= htmlspecialchars($offer['tag']) ?></span></div>
          <div>
            <h3 class="mb-1"><?= htmlspecialchars($offer['title']) ?></h3>
            <p><?= htmlspecialchars($offer['text']) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
