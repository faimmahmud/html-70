<?php $pageTitle = 'Login | Aurelia Travel'; require_once __DIR__ . '/includes/header.php'; ?>
<section class="section pt-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 reveal">
        <div class="glass-card rounded-5 p-4 p-lg-5">
          <h2 class="fw-bold mb-2">Welcome back</h2>
          <p class="small-muted">Login using the demo account or your own registered user.</p>
          <form data-auth-form="login" class="mt-4">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-lux w-100" type="submit">Login</button>
            <div class="form-message"></div>
          </form>
          <p class="small-muted mt-3 mb-0">Admin demo: admin@demo.com / admin123</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
