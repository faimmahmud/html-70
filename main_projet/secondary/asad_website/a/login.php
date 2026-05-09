<?php
$pageTitle = 'Login | Aurelia Estates';
$currentPage = 'login';
require_once __DIR__ . '/includes/header.php';
?>
<section class="py-5">
  <div class="container" style="max-width: 900px;">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="surface h-100">
          <h2 class="section-title">Login</h2>
          <p class="text-secondary">Access saved homes, bookings, and your message inbox.</p>
          <form class="d-grid gap-3">
            <input type="email" class="form-control" placeholder="Email address">
            <input type="password" class="form-control" placeholder="Password">
            <button type="button" class="btn btn-accent">Sign in</button>
            <a href="#" class="small text-secondary">Forgot password?</a>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="surface h-100">
          <h2 class="section-title">Create account</h2>
          <p class="text-secondary">Register as a buyer, renter, seller, or agent.</p>
          <form class="d-grid gap-3">
            <input type="text" class="form-control" placeholder="Full name">
            <input type="email" class="form-control" placeholder="Email address">
            <input type="password" class="form-control" placeholder="Password">
            <select class="form-select">
              <option>Select role</option>
              <option>Buyer / Renter</option>
              <option>Agent / Seller</option>
            </select>
            <button type="button" class="btn btn-outline-light">Create account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
