<?php
$pageTitle = 'Buyer Dashboard | Aurelia Estates';
$currentPage = 'dashboard';
require_once __DIR__ . '/includes/header.php';
require_login();
$stats = user_stats();
$recent = recent_views();
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Buyer workspace</span>
        <h1 class="section-title mt-2">Wishlist, bookings, and recommendations.</h1>
      </div>
      <a href="listings.php" class="btn btn-accent">Browse listings</a>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Wishlist</div><div class="h2 mb-0"><?php echo (int)$stats['wishlist']; ?></div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Bookings</div><div class="h2 mb-0"><?php echo (int)$stats['bookings']; ?></div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Inquiries</div><div class="h2 mb-0"><?php echo (int)$stats['inquiries']; ?></div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Views</div><div class="h2 mb-0"><?php echo (int)$stats['views']; ?></div></div></div>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="surface">
          <h4>Recently viewed</h4>
          <div class="row g-3 mt-2">
            <?php foreach ($recent as $item): ?>
            <div class="col-md-6">
              <div class="listing-card h-100 mini-card">
                <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>">
                <div class="body">
                  <div class="fw-semibold"><?php echo e($item['title']); ?></div>
                  <small class="text-secondary"><?php echo e($item['city']); ?></small>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="surface h-100">
          <h4>Saved search</h4>
          <form action="actions.php" method="post" class="d-grid gap-2">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="save_search">
            <input name="name" class="form-control" placeholder="Search name" required>
            <textarea name="query_json" class="form-control" rows="5" placeholder='{"city":"Dubai","listing_type":"sale"}'></textarea>
            <button class="btn btn-accent">Save search</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
