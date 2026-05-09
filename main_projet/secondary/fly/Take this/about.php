<?php
$pageTitle = 'About | Fly Soul';
$pageDescription = 'About Fly Soul travel platform.';
$activePage = 'support';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">About</div>
    <h1 class="section-title mb-2">A polished travel booking experience</h1>
    <p class="mb-0">Fly Soul brings flights, hotels, and travel services into one calm, premium interface.</p>
  </div>
</section>

<section class="container py-5">
  <div class="row g-4 align-items-stretch">
    <div class="col-lg-7">
      <div class="section-card h-100">
        <h2 class="section-title mb-3">Built for modern travelers</h2>
        <p class="section-sub">From destination discovery to booking confirmation, the design keeps every step clear and easy to use.</p>
        <div class="row g-3 mt-3">
          <div class="col-md-4"><div class="list-item h-100"><strong>Flights</strong><div class="mini-text mt-1">Fast booking flow</div></div></div>
          <div class="col-md-4"><div class="list-item h-100"><strong>Hotels</strong><div class="mini-text mt-1">Compare stays quickly</div></div></div>
          <div class="col-md-4"><div class="list-item h-100"><strong>Support</strong><div class="mini-text mt-1">Simple help center</div></div></div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="booking-summary p-4 h-100">
        <h3 class="fw-bold mb-3">What we focus on</h3>
        <p class="text-white-50">Clean layouts, strong imagery, and familiar booking actions that feel consistent across the entire website.</p>
        <div class="soft-line"></div>
        <p class="mb-0 text-white-50">The same image style is used across home, destination, package, and service pages for a coherent look.</p>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
