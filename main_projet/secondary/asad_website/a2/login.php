<?php
$pageTitle = 'Login | Aurelia Estates';
$currentPage = 'login';
require_once __DIR__ . '/includes/header.php';
?>
<section class="py-5">
  <div class="container" style="max-width: 1040px;">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="auth-card h-100">
          <h2 class="section-title">Login</h2>
          <p class="text-secondary">Access saved homes, bookings, and your inbox.</p>
          <form id="loginForm" class="d-grid gap-3">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="login">
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn btn-accent">Sign in</button>
          </form>
          <div class="mt-3 small text-secondary">Demo: admin@example.com / Password123!</div>
        </div>
      </div>
      <div class="col-lg-6" id="register">
        <div class="auth-card h-100">
          <h2 class="section-title">Create account</h2>
          <p class="text-secondary">Register as buyer, agent, or seller.</p>
          <form id="registerForm" class="d-grid gap-3">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="register">
            <input type="text" name="name" class="form-control" placeholder="Full name" required>
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
            <input type="password" name="password" class="form-control" placeholder="Password (8+ chars)" required>
            <select name="role" class="form-select">
              <option value="buyer">Buyer / Renter</option>
              <option value="agent">Agent / Seller</option>
              <option value="seller">Seller</option>
            </select>
            <div class="row g-2">
              <div class="col-6"><select name="language" class="form-select"><option value="en">English</option><option value="bn">Bangla</option></select></div>
              <div class="col-6"><input name="currency" class="form-control" value="USD" placeholder="Currency"></div>
            </div>
            <button type="submit" class="btn btn-outline-light">Create account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
window.CSRF_TOKEN = <?php echo json_encode(csrf_token()); ?>;
async function sendForm(form, target) {
  const body = new FormData(form);
  const res = await fetch('actions.php', { method: 'POST', body });
  const json = await res.json();
  if (json.redirect) location.href = json.redirect;
  else alert(json.message || (json.success ? 'Done' : 'Error'));
}
document.getElementById('loginForm').addEventListener('submit', e => { e.preventDefault(); sendForm(e.target); });
document.getElementById('registerForm').addEventListener('submit', e => { e.preventDefault(); sendForm(e.target); });
</script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
