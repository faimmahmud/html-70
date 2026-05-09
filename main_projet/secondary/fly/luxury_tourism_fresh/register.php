<?php $pageTitle = 'Register | Aurelia Travel'; require_once __DIR__ . '/includes/header.php'; ?>
<section class="section pt-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 reveal">
        <div class="glass-card rounded-5 p-4 p-lg-5">
          <h2 class="fw-bold mb-2">Create your account</h2>
          <p class="small-muted">Register to save bookings and access the premium travel flow.</p>
          <form data-auth-form="register" class="mt-4">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" minlength="6" required>
            </div>
            <button class="btn btn-lux w-100" type="submit">Register</button>
            <div class="form-message"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
