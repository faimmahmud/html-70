<?php
$pageTitle = 'Admin Panel | Aurelia Estates';
$currentPage = 'admin';
require_once __DIR__ . '/includes/header.php';
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Operations</span>
        <h1 class="section-title mt-2">Admin panel for trust, safety, and control.</h1>
      </div>
      <button class="btn btn-outline-light">Export report</button>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="surface">
          <h4>Users</h4>
          <p class="text-secondary">Manage buyers, sellers, agents, and staff roles.</p>
          <button class="btn btn-accent w-100">Open user manager</button>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="surface">
          <h4>Listings moderation</h4>
          <p class="text-secondary">Approve or reject properties before they go live.</p>
          <button class="btn btn-accent w-100">Review queue</button>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="surface">
          <h4>Transactions</h4>
          <p class="text-secondary">Monitor payments, refunds, and disputes in one place.</p>
          <button class="btn btn-accent w-100">Open transactions</button>
        </div>
      </div>
    </div>

    <div class="surface mt-4">
      <h4>Audit log</h4>
      <div class="timeline-item mt-4">
        <div class="fw-semibold">Property approved</div>
        <small class="text-secondary">Moderator A • 6 min ago</small>
      </div>
      <div class="timeline-item mt-4">
        <div class="fw-semibold">Refund processed</div>
        <small class="text-secondary">Finance Team • 22 min ago</small>
      </div>
      <div class="timeline-item mt-4">
        <div class="fw-semibold">User role updated</div>
        <small class="text-secondary">Admin • 1 hour ago</small>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
