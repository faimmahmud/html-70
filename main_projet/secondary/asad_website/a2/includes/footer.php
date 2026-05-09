</main>
<footer class="footer mt-5 py-5">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-md-4">
        <h5 class="fw-bold">Aurelia Estates</h5>
        <p class="text-secondary mb-0">Premium listings, private tours, smart filters, and clean dashboards in one place.</p>
      </div>
      <div class="col-md-2">
        <h6 class="text-uppercase text-secondary small">Explore</h6>
        <ul class="list-unstyled mb-0">
          <li><a href="index.php">Home</a></li>
          <li><a href="listings.php">Listings</a></li>
          <li><a href="compare.php">Compare</a></li>
          <li><a href="calculator.php">Calculator</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <h6 class="text-uppercase text-secondary small">Account</h6>
        <ul class="list-unstyled mb-0">
          <li><a href="login.php">Login</a></li>
          <li><a href="dashboard-buyer.php">Buyer dashboard</a></li>
          <li><a href="dashboard-agent.php">Agent dashboard</a></li>
          <li><a href="admin.php">Admin panel</a></li>
        </ul>
      </div>
      <div class="col-md-4 text-md-end">
        <span class="badge rounded-pill text-bg-dark border border-light-subtle">Bootstrap 5</span>
        <span class="badge rounded-pill text-bg-dark border border-light-subtle">PHP 8</span>
        <span class="badge rounded-pill text-bg-dark border border-light-subtle">PDO</span>
      </div>
    </div>
    <hr class="border-secondary my-4">
    <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
      <small class="text-secondary">© <?php echo date('Y'); ?> Aurelia Estates.</small>
      <small class="text-secondary">White-on-dark premium real-estate UI</small>
    </div>
  </div>
</footer>
<script>window.CSRF_TOKEN = <?php echo json_encode(csrf_token()); ?>;</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
