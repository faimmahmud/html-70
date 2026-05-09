<?php
$pageTitle = 'Admin Panel | Aurelia Estates';
$currentPage = 'admin';
require_once __DIR__ . '/includes/header.php';
require_role(['admin']);
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Operations</span>
        <h1 class="section-title mt-2">Admin control for trust, safety, and growth.</h1>
      </div>
      <button class="btn btn-outline-light">Export report</button>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Users</div><div class="h2 mb-0">1,248</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Pending approvals</div><div class="h2 mb-0">14</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Transactions</div><div class="h2 mb-0">$81K</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Conversion</div><div class="h2 mb-0">9.2%</div></div></div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="surface">
          <h4>Users & roles</h4>
          <p class="text-secondary">Manage buyers, agents, sellers, and staff roles.</p>
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
      <h4>Material rate control</h4>
      <form action="actions.php" method="post" class="row g-3 mt-2">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="save_rate">
        <div class="col-md-4"><input name="material_name" class="form-control" placeholder="Material name" required></div>
        <div class="col-md-3"><input name="rate" type="number" class="form-control" placeholder="Rate" required></div>
        <div class="col-md-3"><input name="unit" class="form-control" placeholder="Unit" value="per sqft"></div>
        <div class="col-md-2"><button class="btn btn-accent w-100">Save</button></div>
      </form>
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
