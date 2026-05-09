<?php
$pageTitle = 'Booking | Aurelia Travel';
require_once __DIR__ . '/includes/header.php';
$sel = (int)($_GET['package'] ?? 0);
?>
<section class="section pt-4">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-5 reveal">
        <div class="full-screen-panel h-100">
          <div class="panel-media" data-parallax="0.06" style="background-image:url('<?php echo e($featuredTours[0]['image']); ?>')"></div>
          <div class="panel-content">
            <span class="kicker mb-3"><i class="fa-solid fa-pen-to-square"></i> Booking page</span>
            <h1 class="section-title mb-3">Book your next premium journey</h1>
            <p class="small-muted mb-4">A clean booking form with validation and AJAX submission for a smooth user flow.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 reveal">
        <div class="glass-card rounded-5 p-4 p-lg-5">
          <h3 class="fw-bold mb-3">Reservation form</h3>
          <form id="bookingForm" class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Package</label>
              <select name="package" class="form-select" required>
                <option value="">Select package</option>
                <?php foreach (packages_all() as $p): ?>
                  <option value="<?php echo e($p['title']); ?>" <?php echo $sel === (int)$p['id'] ? 'selected' : ''; ?>><?php echo e($p['title']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Travel Date</label>
              <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">People</label>
              <input type="number" name="people" class="form-control" min="1" value="2" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control" rows="5" placeholder="Tell us about your dream trip..."></textarea>
            </div>
            <div class="col-12">
              <button class="btn btn-lux px-4" type="submit">Submit Booking</button>
            </div>
          </form>
          <div id="bookingResult"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
