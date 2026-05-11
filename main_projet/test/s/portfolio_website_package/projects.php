<?php
$pageTitle = 'Projects — Faim Portfolio';
$pageDescription = 'Projects page with filterable portfolio cards.';
include 'includes/header.php';
?>
<section class="page-hero section-pad">
  <div class="container">
    <span class="eyebrow reveal">Projects</span>
    <h1 class="hero-title reveal">A compact portfolio that still feels premium.</h1>
    <p class="lead text-secondary col-lg-8 reveal">Use the filters to browse by category. The interaction is handled with jQuery, and the cards are styled for a modern, high-trust presentation.</p>
  </div>
</section>

<section class="section-pad section-soft">
  <div class="container">
    <div class="filter-bar reveal">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="web">Web Design</button>
      <button class="filter-btn" data-filter="saas">SaaS</button>
      <button class="filter-btn" data-filter="brand">Brand</button>
    </div>

    <div class="row g-4 mt-3" id="projectGrid">
      <div class="col-md-6 col-lg-4 project-item" data-category="saas web">
        <div class="project-card h-100">
          <img src="assets/images/project-1.svg" alt="PulseBoard project">
          <div class="p-4">
            <span class="tag">SaaS</span>
            <h3>PulseBoard</h3>
            <p>A dashboard concept for product analytics and retention insights.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 project-item" data-category="web brand">
        <div class="project-card h-100">
          <img src="assets/images/project-2.svg" alt="Nexus Studio project">
          <div class="p-4">
            <span class="tag">Agency</span>
            <h3>Nexus Studio</h3>
            <p>A lead-focused website for a digital product studio.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 project-item" data-category="brand web">
        <div class="project-card h-100">
          <img src="assets/images/project-3.svg" alt="Creator portfolio project">
          <div class="p-4">
            <span class="tag">Brand</span>
            <h3>Creator Portfolio</h3>
            <p>A personal brand site built to communicate expertise fast.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 project-item" data-category="web">
        <div class="project-card h-100">
          <img src="assets/images/project-4.svg" alt="Ecommerce concept">
          <div class="p-4">
            <span class="tag">E-commerce</span>
            <h3>Nova Commerce</h3>
            <p>A storefront concept with conversion-friendly product presentation.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 project-item" data-category="saas">
        <div class="project-card h-100">
          <img src="assets/images/project-5.svg" alt="Subscription service project">
          <div class="p-4">
            <span class="tag">SaaS</span>
            <h3>Orbit Flow</h3>
            <p>A subscription product landing page with clear pricing hierarchy.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 project-item" data-category="brand">
        <div class="project-card h-100">
          <img src="assets/images/project-6.svg" alt="Consulting portfolio project">
          <div class="p-4">
            <span class="tag">Consulting</span>
            <h3>North Advisory</h3>
            <p>A high-trust service website for a consulting business.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
