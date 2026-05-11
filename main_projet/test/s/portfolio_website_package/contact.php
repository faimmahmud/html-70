<?php
$pageTitle = 'Contact — Faim Portfolio';
$pageDescription = 'Contact page and PHP form endpoint.';
include 'includes/header.php';
$success = isset($_GET['success']);
$error = isset($_GET['error']);
?>
<section class="page-hero section-pad">
  <div class="container">
    <span class="eyebrow reveal">Contact</span>
    <h1 class="hero-title reveal">Send the brief. Keep it clear.</h1>
    <p class="lead text-secondary col-lg-8 reveal">The form is set up for PHP handling and can be wired to your hosting mail configuration. Keep the message concise, specific, and outcome-focused.</p>
  </div>
</section>

<section class="section-pad section-soft">
  <div class="container">
    <?php if ($success): ?>
      <div class="alert alert-success reveal">Message sent successfully. I will get back to you soon.</div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-danger reveal">Please check the form fields and try again.</div>
    <?php endif; ?>
    <div class="row g-4">
      <div class="col-lg-5 reveal">
        <div class="panel h-100">
          <h2>Direct contact</h2>
          <p class="text-secondary">hello@yourdomain.com</p>
          <p class="text-secondary">Dhaka, Bangladesh</p>
          <p class="text-secondary mb-0">Best for portfolio work, landing pages, business sites, and product-facing web builds.</p>
        </div>
      </div>
      <div class="col-lg-7 reveal">
        <form class="contact-form" action="assets/php/contact-form.php" method="post">
          <div class="row g-3">
            <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Your name" required></div>
            <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email address" required></div>
            <div class="col-12"><input type="text" name="subject" class="form-control" placeholder="Subject" required></div>
            <div class="col-12"><textarea name="message" rows="6" class="form-control" placeholder="Project details" required></textarea></div>
            <div class="col-12 d-flex gap-3 flex-wrap">
              <button type="submit" class="btn btn-accent btn-lg">Send message</button>
              <a href="projects.php" class="btn btn-outline-light btn-lg">View work</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
