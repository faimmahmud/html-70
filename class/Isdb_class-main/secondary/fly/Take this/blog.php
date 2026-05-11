<?php
$pageTitle = 'Blog | Fly Soul';
$pageDescription = 'Travel tips and booking guides.';
$activePage = 'support';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">Blog</div>
    <h1 class="section-title mb-2">Travel guides and tips</h1>
    <p class="mb-0">A few helpful posts to make planning easier.</p>
  </div>
</section>

<section class="container py-5">
  <div class="row g-4">
    <?php foreach ($blogPosts as $post): ?>
      <div class="col-md-6 col-lg-4">
        <div class="destination-card h-100">
          <div class="destination-photo"><img src="assets/img/hero-bg.jpg" alt="Travel guide"></div>
          <div class="destination-body">
            <h5 class="mb-2"><?= htmlspecialchars($post['title']) ?></h5>
            <p class="mini-text mb-0">Short guide preview for <?= htmlspecialchars($post['slug']) ?>.</p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
