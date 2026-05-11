<?php
$pageTitle = 'Blog';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
$posts = get_blog_posts();
?>
<div class="container py-5">
  <h1 class="section-title mb-4">Blog</h1>
  <div class="row g-4">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-4">
      <div class="card-soft p-4 h-100">
        <div class="text-muted small mb-2"><?= esc($post['date']) ?></div>
        <h5 class="fw-bold"><?= esc($post['title']) ?></h5>
        <p class="text-muted mb-0"><?= esc($post['excerpt']) ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
