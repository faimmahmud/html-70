<?php
$pageTitle = 'Contact';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
$sent = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-6">
      <h1 class="section-title">Contact</h1>
      <p class="text-muted">Reach out for booking support or website inquiries.</p>
      <?php if ($sent): ?>
        <div class="alert alert-success">Message received. Thank you.</div>
      <?php endif; ?>
      <form method="post" class="card-soft p-4">
        <div class="mb-3"><input class="form-control" name="name" placeholder="Your name" required></div>
        <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email address" required></div>
        <div class="mb-3"><textarea class="form-control" name="message" rows="5" placeholder="Your message" required></textarea></div>
        <button class="btn btn-dark">Send Message</button>
      </form>
    </div>
    <div class="col-lg-6">
      <div class="card-soft p-4 h-100">
        <h5 class="fw-bold">Support</h5>
        <p class="text-muted mb-2">Email: support@terravista.com</p>
        <p class="text-muted mb-0">Worldwide tourism assistance and booking guidance.</p>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
