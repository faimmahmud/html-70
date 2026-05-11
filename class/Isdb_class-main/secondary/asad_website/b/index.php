<?php
require_once __DIR__ . '/includes/config.php';
$properties = json_decode(file_get_contents(__DIR__ . '/data/properties.json'), true);

$locations = array_values(array_unique(array_map(fn($p) => explode(',', $p['location'])[0], $properties)));
$types = array_values(array_unique(array_map(fn($p) => $p['type'], $properties)));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Arc Estate — Modern Real Estate Marketplace</title>
  <meta name="description" content="A premium real estate marketplace for buying, selling, and renting properties globally.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-3 fixed-top nav-blur">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#hero">Arc Estate</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
        <li class="nav-item"><a class="nav-link" href="#listings">Listings</a></li>
        <li class="nav-item"><a class="nav-link" href="#agents">Agents</a></li>
        <li class="nav-item"><a class="nav-link" href="#dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="btn btn-accent px-4" href="#contact">List Property</a></li>
      </ul>
    </div>
  </div>
</nav>

<header id="hero" class="hero-section">
  <div class="container position-relative z-2 pt-5">
    <div class="row align-items-center min-vh-100 py-5">
      <div class="col-lg-6">
        <span class="badge rounded-pill text-bg-light mb-3">Global Real Estate Marketplace</span>
        <h1 class="display-3 fw-bold lh-1 mb-4">Find your next home, investment, or rental in one premium platform.</h1>
        <p class="lead text-secondary mb-4">Arc-style design, smart search, verified listings, multi-currency pricing, and seamless booking for property visits.</p>

        <div class="search-card shadow-lg rounded-4 p-3 p-md-4">
          <form class="row g-2 align-items-end" id="searchForm">
            <div class="col-md-5">
              <label class="form-label small text-muted">Location</label>
              <input type="text" class="form-control form-control-lg" id="searchLocation" placeholder="Dubai, London, Miami">
            </div>
            <div class="col-md-3">
              <label class="form-label small text-muted">Type</label>
              <select class="form-select form-select-lg" id="searchType">
                <option value="">Any</option>
                <?php foreach ($types as $type): ?>
                  <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label small text-muted">Currency</label>
              <select class="form-select form-select-lg" id="currencySelect">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="AED">AED</option>
              </select>
            </div>
            <div class="col-md-2 d-grid">
              <button class="btn btn-accent btn-lg" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>

        <div class="d-flex flex-wrap gap-3 mt-4 text-secondary small">
          <span><i class="bi bi-patch-check-fill text-accent"></i> Verified listings</span>
          <span><i class="bi bi-globe2 text-accent"></i> Multi-language ready</span>
          <span><i class="bi bi-wallet2 text-accent"></i> Multi-currency support</span>
        </div>
      </div>
      <div class="col-lg-6 mt-5 mt-lg-0">
        <div class="hero-visual position-relative">
          <img src="<?= htmlspecialchars($properties[0]['image']) ?>" alt="Featured property" class="img-fluid rounded-5 shadow-lg hero-img">
          <div class="floating-card card border-0 shadow-lg">
            <div class="card-body d-flex gap-3 align-items-center">
              <div class="icon-badge"><i class="bi bi-house-heart"></i></div>
              <div>
                <div class="fw-semibold">Featured: <?= htmlspecialchars($properties[0]['title']) ?></div>
                <div class="text-secondary small"><?= htmlspecialchars($properties[0]['location']) ?> · <?= htmlspecialchars(format_price($properties[0]['price'], $properties[0]['currency'])) ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<main>
  <section class="py-5" id="listings">
    <div class="container py-4">
      <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
        <div>
          <h2 class="fw-bold mb-1">Featured Listings</h2>
          <p class="text-secondary mb-0">Browse premium homes, rentals, and commercial spaces.</p>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-dark btn-sm filter-btn active" data-filter="all">All</button>
          <button class="btn btn-outline-dark btn-sm filter-btn" data-filter="For Sale">For Sale</button>
          <button class="btn btn-outline-dark btn-sm filter-btn" data-filter="For Rent">For Rent</button>
        </div>
      </div>

      <div class="row g-4" id="propertiesGrid">
        <?php foreach ($properties as $property): ?>
          <div class="col-md-6 col-xl-4 property-card-wrap"
               data-location="<?= strtolower(htmlspecialchars($property['location'])) ?>"
               data-type="<?= strtolower(htmlspecialchars($property['type'])) ?>"
               data-status="<?= htmlspecialchars($property['status']) ?>">
            <div class="card property-card h-100 border-0 shadow-sm">
              <div class="position-relative">
                <img src="<?= htmlspecialchars($property['image']) ?>" class="card-img-top property-img" alt="<?= htmlspecialchars($property['title']) ?>">
                <span class="badge bg-dark position-absolute top-0 start-0 m-3"><?= htmlspecialchars($property['badge']) ?></span>
                <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-3 wishlist-btn" data-id="<?= $property['id'] ?>"><i class="bi bi-heart"></i></button>
              </div>
              <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                  <div>
                    <h5 class="card-title mb-1"><?= htmlspecialchars($property['title']) ?></h5>
                    <div class="text-secondary small"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($property['location']) ?></div>
                  </div>
                  <div class="text-end">
                    <div class="fw-bold fs-5 price" data-price="<?= $property['price'] ?>" data-currency="<?= htmlspecialchars($property['currency']) ?>"><?= htmlspecialchars(format_price($property['price'], $property['currency'])) ?></div>
                    <div class="text-secondary small"><?= htmlspecialchars($property['status']) ?></div>
                  </div>
                </div>
                <div class="d-flex gap-3 text-secondary small mb-3">
                  <span><i class="bi bi-door-open"></i> <?= (int)$property['beds'] ?> Beds</span>
                  <span><i class="bi bi-droplet"></i> <?= (int)$property['baths'] ?> Baths</span>
                  <span><i class="bi bi-rulers"></i> <?= (int)$property['area'] ?> sqft</span>
                </div>
                <p class="text-secondary small flex-grow-1"><?= htmlspecialchars($property['description']) ?></p>
                <div class="d-flex gap-2">
                  <button class="btn btn-accent flex-grow-1 view-details"
                          data-property='<?= htmlspecialchars(json_encode($property), ENT_QUOTES) ?>'
                          data-bs-toggle="modal" data-bs-target="#propertyModal">View Details</button>
                  <a href="#contact" class="btn btn-outline-dark">Contact</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="py-5 bg-soft">
    <div class="container py-4">
      <div class="row g-4 text-center">
        <div class="col-md-3"><div class="stats-card"><div class="fs-2 fw-bold">12K+</div><div class="text-secondary">Active Listings</div></div></div>
        <div class="col-md-3"><div class="stats-card"><div class="fs-2 fw-bold">4.9/5</div><div class="text-secondary">User Rating</div></div></div>
        <div class="col-md-3"><div class="stats-card"><div class="fs-2 fw-bold">50+</div><div class="text-secondary">Countries</div></div></div>
        <div class="col-md-3"><div class="stats-card"><div class="fs-2 fw-bold">24/7</div><div class="text-secondary">Support</div></div></div>
      </div>
    </div>
  </section>

  <section class="py-5" id="agents">
    <div class="container py-4">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <h2 class="fw-bold mb-3">Trusted agents, seller dashboards, and verified listings.</h2>
          <p class="text-secondary">Give agents a polished dashboard for managing properties, leads, analytics, and premium subscriptions.</p>
          <div class="d-flex gap-3 mt-4">
            <div class="feature-pill"><i class="bi bi-graph-up-arrow"></i> Analytics</div>
            <div class="feature-pill"><i class="bi bi-shield-check"></i> Verification</div>
            <div class="feature-pill"><i class="bi bi-chat-dots"></i> Messaging</div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="dashboard-preview shadow-lg rounded-5 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <div class="small text-secondary">Agent Dashboard</div>
                <div class="fw-semibold">Property Performance</div>
              </div>
              <span class="badge text-bg-light">Live</span>
            </div>
            <div class="row g-3">
              <div class="col-4"><div class="mini-stat"><div class="fw-bold">312</div><div class="small text-secondary">Views</div></div></div>
              <div class="col-4"><div class="mini-stat"><div class="fw-bold">48</div><div class="small text-secondary">Leads</div></div></div>
              <div class="col-4"><div class="mini-stat"><div class="fw-bold">18</div><div class="small text-secondary">Bookings</div></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-soft" id="dashboard">
    <div class="container py-4">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <h5 class="fw-bold">User Dashboard</h5>
              <p class="text-secondary mb-0">Saved properties, booking history, and personalized recommendations.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <h5 class="fw-bold">Payments & Booking</h5>
              <p class="text-secondary mb-0">Secure multi-currency checkout, deposits, and visit scheduling.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <h5 class="fw-bold">SEO & Growth</h5>
              <p class="text-secondary mb-0">SEO-friendly URLs, blog content, and lead-generation optimized pages.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5" id="contact">
    <div class="container py-4">
      <div class="row g-4 align-items-center">
        <div class="col-lg-5">
          <h2 class="fw-bold mb-3">List your property.</h2>
          <p class="text-secondary">A simple contact form that can be connected to PHP mail, CRM, or a database backend.</p>
        </div>
        <div class="col-lg-7">
          <form class="card border-0 shadow-sm p-4" action="process_contact.php" method="post">
            <div class="row g-3">
              <div class="col-md-6"><input name="name" class="form-control form-control-lg" placeholder="Your name" required></div>
              <div class="col-md-6"><input name="email" type="email" class="form-control form-control-lg" placeholder="Email address" required></div>
              <div class="col-12"><input name="subject" class="form-control form-control-lg" placeholder="Property title or inquiry subject" required></div>
              <div class="col-12"><textarea name="message" class="form-control" rows="4" placeholder="Tell us about the property or your requirements"></textarea></div>
              <div class="col-12 d-grid d-md-flex justify-content-md-end"><button class="btn btn-accent btn-lg px-4" type="submit">Send Inquiry</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<footer class="py-4 border-top">
  <div class="container d-flex flex-wrap justify-content-between gap-2 small text-secondary">
    <span>© <?= date('Y') ?> Arc Estate</span>
    <span>Built with PHP, Bootstrap, and JavaScript</span>
  </div>
</footer>

<div class="modal fade" id="propertyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content border-0 rounded-5 overflow-hidden">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="modalTitle">Property Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-0">
        <div class="row g-4">
          <div class="col-lg-7">
            <img id="modalImage" src="" class="img-fluid rounded-4 mb-3" alt="Property image">
            <div class="d-flex gap-2 flex-wrap" id="modalGallery"></div>
          </div>
          <div class="col-lg-5">
            <div class="text-secondary small mb-2" id="modalLocation"></div>
            <div class="fs-3 fw-bold mb-2" id="modalPrice"></div>
            <p class="text-secondary" id="modalDesc"></p>
            <div class="row g-2 mb-3">
              <div class="col-4"><div class="mini-stat text-center"><div class="fw-bold" id="modalBeds"></div><div class="small text-secondary">Beds</div></div></div>
              <div class="col-4"><div class="mini-stat text-center"><div class="fw-bold" id="modalBaths"></div><div class="small text-secondary">Baths</div></div></div>
              <div class="col-4"><div class="mini-stat text-center"><div class="fw-bold" id="modalArea"></div><div class="small text-secondary">Sqft</div></div></div>
            </div>
            <div class="d-grid gap-2">
              <a href="#contact" class="btn btn-accent btn-lg">Contact Agent</a>
              <button class="btn btn-outline-dark btn-lg" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
