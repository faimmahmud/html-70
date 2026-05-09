<?php
require_once __DIR__ . '/includes/functions.php';

if (!current_user()) {
    flash_set('warning', 'Please log in or create an account before booking tickets.');
    redirect(app_path('login.php?redirect=' . rawurlencode(app_path('booking.php'))));
}

$pageTitle = 'Booking | ' . $site['brand'];
require_once __DIR__ . '/includes/header.php';

$selectedPackageId = trim($_GET['package_id'] ?? '');
$selectedPackageName = trim($_GET['package_name'] ?? ($_GET['package'] ?? ''));
$selectedCountry = trim($_GET['country'] ?? '');
$selectedAmount = trim($_GET['amount'] ?? '');
$selectedType = trim($_GET['booking_type'] ?? 'package');
$packages = read_packages();

if ($selectedPackageId !== '' && $selectedPackageName === '') {
    foreach ($packages as $pkg) {
        if (($pkg['id'] ?? '') === $selectedPackageId) {
            $selectedPackageName = $pkg['title'] ?? '';
            $selectedCountry = $pkg['country'] ?? $selectedCountry;
            $selectedAmount = preg_replace('/[^0-9.]/', '', (string)($pkg['price'] ?? ''));
            break;
        }
    }
}
?>
<section class="hero-shell" style="min-height:72vh;">
  <div class="hero-bg active" style="background-image:url('<?= e(travel_img('booking-hero')) ?>');opacity:1"></div>
  <div class="hero-gradient"></div>
  <div class="container hero-content">
    <div class="row">
      <div class="col-lg-8">
        <span class="hero-kicker reveal">Booking</span>
        <h1 class="hero-title mt-3 reveal" style="max-width:11ch;">Reserve your next premium journey</h1>
        <p class="hero-lead mt-3 reveal">Package booking, ticket booking, payment method capture, and detailed admin tracking in one flow.</p>
      </div>
    </div>
  </div>
</section>

<section class="arc-section arc-top" id="booking">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-5">
        <div class="full-hero-card reveal" style="min-height:100%; min-height:560px;">
          <div class="card-image" style="background-image:url('<?= e(travel_img('booking-side')) ?>')"></div>
          <div class="content">
            <span class="eyebrow">Concierge support</span>
            <h3 class="mt-3">Smooth, premium, and ready to convert.</h3>
            <p class="mt-2">The booking flow now tracks package or ticket type, travel dates, leaving time, payment method, and admin visibility.</p>
            <div class="feature-list">
              <span>AJAX submit</span>
              <span>Booking ref</span>
              <span>Payment method</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="form-shell p-4 p-lg-5 reveal">
          <div class="section-kicker">Booking form</div>
          <h2 class="section-title mb-3">Plan your travel in one step</h2>
          <div id="bookingSuccess" class="alert alert-success d-none"></div>
          <div id="bookingError" class="alert alert-danger d-none"></div>
          <form id="bookingForm" action="<?= e(app_path('includes/booking-submit.php')) ?>" method="post" class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Booking type</label>
              <select name="booking_type" class="form-select" required>
                <option value="package" <?= $selectedType === 'package' ? 'selected' : '' ?>>Package</option>
                <option value="ticket" <?= $selectedType === 'ticket' ? 'selected' : '' ?>>Ticket</option>
                <option value="tour" <?= $selectedType === 'tour' ? 'selected' : '' ?>>Tour</option>
              </select>
            </div>
            <div class="col-md-8">
              <label class="form-label">Package / ticket name</label>
              <input type="text" name="package_name" class="form-control" list="packageSuggestions" value="<?= e($selectedPackageName) ?>" placeholder="Choose a package or type a ticket name" required>
              <datalist id="packageSuggestions">
                <?php foreach ($packages as $pkg): ?>
                  <option value="<?= e($pkg['title'] ?? '') ?>"></option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div class="col-md-4">
              <label class="form-label">Package ID</label>
              <input type="text" name="package_id" class="form-control" value="<?= e($selectedPackageId) ?>" placeholder="Optional package code">
            </div>
            <div class="col-md-4">
              <label class="form-label">Country / route</label>
              <input type="text" name="country" class="form-control" value="<?= e($selectedCountry) ?>" placeholder="e.g. Maldives">
            </div>
            <div class="col-md-4">
              <label class="form-label">Amount</label>
              <input type="text" name="amount" class="form-control" value="<?= e($selectedAmount) ?>" placeholder="0.00">
            </div>
            <div class="col-md-6">
              <label class="form-label">Departure from</label>
              <input type="text" name="departure_from" class="form-control" placeholder="e.g. Dhaka">
            </div>
            <div class="col-md-6">
              <label class="form-label">Destination</label>
              <input type="text" name="destination" class="form-control" placeholder="e.g. Cox's Bazar">
            </div>
            <div class="col-md-6">
              <label class="form-label">Travel date</label>
              <input type="date" name="travel_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Travel time</label>
              <input type="time" name="travel_time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Leaving date</label>
              <input type="date" name="leave_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Leaving time</label>
              <input type="time" name="leave_time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Travelers / tickets</label>
              <input type="number" min="1" name="guests" class="form-control" value="1" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Payment method</label>
              <select name="payment_method" class="form-select" required>
                <option value="cash">Cash</option>
                <option value="bkash">bKash</option>
                <option value="nagad">Nagad</option>
                <option value="rocket">Rocket</option>
                <option value="card">Card</option>
                <option value="bank">Bank transfer</option>
                <option value="paypal">PayPal</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Payment reference</label>
              <input type="text" name="payment_reference" class="form-control" placeholder="Transaction ID / note">
            </div>
            <div class="col-md-6">
              <label class="form-label">Your name</label>
              <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="customer_email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" name="customer_phone" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea name="message" rows="5" class="form-control" placeholder="Any special request?"></textarea>
            </div>
            <div class="col-12 d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-gold px-4">Submit booking</button>
              <a href="<?= e(app_path('packages.php')) ?>" class="btn btn-outline-dark px-4">Browse packages</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
