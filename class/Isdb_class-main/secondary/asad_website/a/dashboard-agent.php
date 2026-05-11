<?php
$pageTitle = 'Agent Dashboard | Aurelia Estates';
$currentPage = 'dashboard';
require_once __DIR__ . '/includes/header.php';
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge badge-soft rounded-pill">Agent workspace</span>
        <h1 class="section-title mt-2">Manage listings, leads, and performance.</h1>
      </div>
      <button class="btn btn-accent">Add new property</button>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Views</div><div class="h2 mb-0">24.8K</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Leads</div><div class="h2 mb-0">312</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Bookings</div><div class="h2 mb-0">48</div></div></div>
      <div class="col-md-3"><div class="panel-card p-4"><div class="small text-secondary">Conversion</div><div class="h2 mb-0">7.6%</div></div></div>
    </div>

    <div class="row g-4">
      <div class="col-lg-7">
        <div class="surface">
          <h4>Property listings</h4>
          <div class="table-responsive mt-3">
            <table class="table table-dark table-borderless align-middle">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Views</th>
                  <th>Clicks</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Ocean View Villa</td>
                  <td><span class="badge text-bg-success">Live</span></td>
                  <td>10.2K</td>
                  <td>884</td>
                  <td><button class="btn btn-sm btn-outline-light">Edit</button></td>
                </tr>
                <tr>
                  <td>Downtown Penthouse</td>
                  <td><span class="badge text-bg-warning">Review</span></td>
                  <td>7.4K</td>
                  <td>540</td>
                  <td><button class="btn btn-sm btn-outline-light">Edit</button></td>
                </tr>
                <tr>
                  <td>Family Apartment</td>
                  <td><span class="badge text-bg-success">Live</span></td>
                  <td>3.2K</td>
                  <td>233</td>
                  <td><button class="btn btn-sm btn-outline-light">Edit</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="surface">
          <h4>Lead inbox</h4>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Emma R.</div>
            <p class="mb-1 text-secondary">Requested a virtual tour for the Malibu villa.</p>
            <small class="text-secondary">2 minutes ago</small>
          </div>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Aman S.</div>
            <p class="mb-1 text-secondary">Asked about deposit and lease duration.</p>
            <small class="text-secondary">18 minutes ago</small>
          </div>
          <div class="timeline-item mt-4">
            <div class="fw-semibold">Olivia P.</div>
            <p class="mb-1 text-secondary">Wants an urgent viewing this weekend.</p>
            <small class="text-secondary">1 hour ago</small>
          </div>
        </div>

        <div class="surface mt-4">
          <h4>Upload media</h4>
          <input type="file" class="form-control mt-3" multiple>
          <button class="btn btn-accent w-100 mt-3">Upload images/videos</button>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
