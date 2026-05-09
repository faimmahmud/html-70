<?php
include "data.php";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Arc Travel | Explore the World</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#"><span class="brand-dot"></span>Arc Travel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="#destinations">Destinations</a></li>
          <li class="nav-item"><a class="nav-link" href="#why">Why Us</a></li>
          <li class="nav-item"><a class="btn btn-dark px-4 ms-lg-2" href="#book">Book Now</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="hero-section">
    <div class="container py-5 py-lg-6">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <span class="badge text-bg-light mb-3">Luxury tourism • global trips • curated experiences</span>
          <h1 class="display-4 fw-bold lh-1 mb-3">Discover unforgettable destinations with a modern travel experience.</h1>
          <p class="lead text-secondary mb-4">Search places, compare experiences, and book premium tours with a clean, minimal interface.</p>

          <div class="search-box p-2 p-md-3 shadow-sm">
            <div class="row g-2">
              <div class="col-md-4">
                <input id="searchInput" class="form-control form-control-lg" placeholder="Search destination">
              </div>
              <div class="col-md-3">
                <select id="categoryFilter" class="form-select form-select-lg">
                  <option value="all">All types</option>
                  <option value="beach">Beach</option>
                  <option value="city">City</option>
                  <option value="adventure">Adventure</option>
                  <option value="mountain">Mountain</option>
                  <option value="culture">Culture</option>
                </select>
              </div>
              <div class="col-md-3">
                <select id="priceFilter" class="form-select form-select-lg">
                  <option value="all">Any budget</option>
                  <option value="low">Under $500</option>
                  <option value="mid">$500 - $1200</option>
                  <option value="high">Above $1200</option>
                </select>
              </div>
              <div class="col-md-2 d-grid">
                <button class="btn btn-primary btn-lg" id="resetBtn">Reset</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-card shadow-lg">
            <div class="row g-3">
              <div class="col-6">
                <img class="img-fluid rounded-4 hero-img" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80" alt="Beach">
              </div>
              <div class="col-6">
                <img class="img-fluid rounded-4 hero-img mt-4" src="https://images.unsplash.com/photo-1519608487953-e999c86e7455?auto=format&fit=crop&w=900&q=80" alt="City">
              </div>
              <div class="col-6">
                <img class="img-fluid rounded-4 hero-img" src="https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?auto=format&fit=crop&w=900&q=80" alt="Mountain">
              </div>
              <div class="col-6">
                <img class="img-fluid rounded-4 hero-img mt-4" src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?auto=format&fit=crop&w=900&q=80" alt="Culture">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="py-5" id="destinations">
      <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
          <div>
            <p class="text-uppercase text-primary fw-semibold mb-1">Featured Trips</p>
            <h2 class="fw-bold mb-0">Top destinations</h2>
          </div>
          <p class="text-secondary mb-0">Pick a place, view details, and send a booking request.</p>
        </div>

        <div class="row g-4" id="destinationGrid">
          <?php foreach ($destinations as $d): ?>
          <div class="col-md-6 col-lg-4 destination-card"
               data-name="<?= htmlspecialchars(strtolower($d['name'])) ?>"
               data-category="<?= htmlspecialchars($d['category']) ?>"
               data-price="<?= htmlspecialchars($d['price']) ?>">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
              <img src="<?= htmlspecialchars($d['image']) ?>" class="card-img-top destination-image" alt="<?= htmlspecialchars($d['name']) ?>">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h5 class="card-title mb-1"><?= htmlspecialchars($d['name']) ?></h5>
                    <small class="text-secondary"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($d['location']) ?></small>
                  </div>
                  <span class="badge text-bg-dark"><?= htmlspecialchars($d['category']) ?></span>
                </div>
                <p class="text-secondary mb-3"><?= htmlspecialchars($d['short']) ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <strong>$<?= htmlspecialchars($d['price']) ?></strong>
                  <button class="btn btn-outline-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#detailsModal"
                    data-name="<?= htmlspecialchars($d['name']) ?>"
                    data-location="<?= htmlspecialchars($d['location']) ?>"
                    data-price="<?= htmlspecialchars($d['price']) ?>"
                    data-description="<?= htmlspecialchars($d['description']) ?>"
                    data-image="<?= htmlspecialchars($d['image']) ?>"
                    data-category="<?= htmlspecialchars($d['category']) ?>">
                    View details
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div id="noResults" class="alert alert-warning mt-4 d-none">No destinations matched your search.</div>
      </div>
    </section>

    <section class="py-5 bg-light" id="why">
      <div class="container">
        <div class="row g-4 text-center">
          <div class="col-md-4">
            <div class="feature-box p-4 h-100 bg-white shadow-sm rounded-4">
              <i class="bi bi-search display-6 text-primary"></i>
              <h5 class="mt-3">Smart Search</h5>
              <p class="text-secondary mb-0">Find destinations by category, budget, and name in seconds.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-box p-4 h-100 bg-white shadow-sm rounded-4">
              <i class="bi bi-map display-6 text-primary"></i>
              <h5 class="mt-3">Map-Friendly</h5>
              <p class="text-secondary mb-0">Built to support map integrations, trip planning, and location insights.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-box p-4 h-100 bg-white shadow-sm rounded-4">
              <i class="bi bi-shield-check display-6 text-primary"></i>
              <h5 class="mt-3">Trusted Booking</h5>
              <p class="text-secondary mb-0">Use the booking form to send simple travel requests safely.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" id="book">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="bg-white shadow-sm rounded-4 p-4 p-lg-5">
              <h3 class="fw-bold mb-3">Book a tour request</h3>
              <form action="submit_booking.php" method="post" class="row g-3">
                <div class="col-md-6">
                  <input class="form-control" name="name" placeholder="Your name" required>
                </div>
                <div class="col-md-6">
                  <input class="form-control" type="email" name="email" placeholder="Email address" required>
                </div>
                <div class="col-md-6">
                  <input class="form-control" name="destination" placeholder="Destination" required>
                </div>
                <div class="col-md-6">
                  <input class="form-control" name="travel_date" type="date" required>
                </div>
                <div class="col-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Tell us your trip preferences"></textarea>
                </div>
                <div class="col-12 d-grid">
                  <button class="btn btn-primary btn-lg">Send Booking Request</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="py-4 border-top bg-white">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <small class="text-secondary">© <?= date('Y') ?> Arc Travel</small>
      <small class="text-secondary">Tourism website starter built with PHP, Bootstrap, and JS</small>
    </div>
  </footer>

  <div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content rounded-4 overflow-hidden">
        <div class="modal-body p-0">
          <div class="row g-0">
            <div class="col-md-6">
              <img id="modalImage" src="" class="w-100 h-100 object-fit-cover" alt="">
            </div>
            <div class="col-md-6 p-4">
              <span class="badge text-bg-primary mb-2" id="modalCategory"></span>
              <h4 class="fw-bold" id="modalTitle"></h4>
              <p class="text-secondary mb-2" id="modalLocation"></p>
              <p id="modalDescription" class="mb-3"></p>
              <h5 class="text-primary mb-4">$<span id="modalPrice"></span></h5>
              <a class="btn btn-dark w-100" href="#book" data-bs-dismiss="modal">Book this trip</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
