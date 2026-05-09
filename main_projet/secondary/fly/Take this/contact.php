<?php
$pageTitle = 'Contact | Fly Soul';
$pageDescription = 'Contact Fly Soul support.';
$activePage = 'support';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">Support</div>
    <h1 class="section-title mb-2">Contact Fly Soul</h1>
    <p class="mb-0">Send a message and the support team can reply with the next step.</p>
  </div>
</section>

<section class="container py-5">
  <div class="row g-4">
    <div class="col-lg-5">
      <div class="booking-summary p-4 h-100">
        <h3 class="fw-bold mb-3">Support details</h3>
        <p class="text-white-50 mb-4">Email, booking help, and travel support information can live here.</p>
        <div class="d-flex justify-content-between py-2 border-bottom border-white border-opacity-10"><span>Email</span><strong>support@flysoul.test</strong></div>
        <div class="d-flex justify-content-between py-2 border-bottom border-white border-opacity-10"><span>Phone</span><strong>+880 1234 567890</strong></div>
        <div class="d-flex justify-content-between py-2"><span>Hours</span><strong>24/7</strong></div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="panel-card p-4 bg-white">
        <div id="contactAlert"></div>
        <form id="contactForm" class="row g-3">
          <div class="col-md-6"><input class="form-control" name="name" placeholder="Your name" required></div>
          <div class="col-md-6"><input class="form-control" name="email" type="email" placeholder="Email" required></div>
          <div class="col-12"><input class="form-control" name="subject" placeholder="Subject" required></div>
          <div class="col-12"><textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea></div>
          <div class="col-12"><button class="btn btn-signup px-4">Send message</button></div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
