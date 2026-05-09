<?php
$pageTitle = 'Book Flight | Fly Soul';
$pageDescription = 'Fast booking with destination, dates, travellers, and payment options.';
$activePage = 'flights';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';

$selectedDestination = $_GET['destination'] ?? '';
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">Flights</div>
    <h1 class="section-title mb-2">Simple booking, premium feeling.</h1>
    <p class="mb-0">Choose a destination, set the date, select payment, and confirm quickly.</p>
  </div>
</section>

<section class="container py-4 py-lg-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="panel-card p-4 bg-white">
        <div id="bookingAlert"></div>
        <form id="bookingForm" class="row g-3">
          <div class="col-md-6"><label class="form-label">Full name</label><input type="text" name="full_name" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Destination</label>
            <select name="destination" id="destination" class="form-select" required>
              <option value="">Choose destination</option>
              <?php foreach ($destinations as $d): ?>
                <option value="<?= htmlspecialchars($d['name']) ?>" data-price="<?= htmlspecialchars($d['price']) ?>" <?= $selectedDestination === $d['name'] ? 'selected' : '' ?>><?= htmlspecialchars($d['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6"><label class="form-label">Travel date</label><input type="date" name="travel_date" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Return date</label><input type="date" name="return_date" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Passengers</label><input type="number" name="passengers" id="passengers" min="1" value="1" class="form-control" required></div>

          <div class="col-12">
            <label class="form-label">Payment method</label>
            <div class="row g-2">
              <?php foreach ($paymentMethods as $pm): ?>
                <div class="col-md-6">
                  <label class="payment-option w-100">
                    <input type="radio" name="payment_method" value="<?= htmlspecialchars($pm['value']) ?>" <?= $pm['value'] === 'card' ? 'checked' : '' ?>> <?= htmlspecialchars($pm['label']) ?>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-12 d-none" id="paymentDetailsWrap">
            <div class="alert alert-light border mb-0"><span id="paymentDetailsNote"></span></div>
          </div>
          <div class="col-md-6"><label class="form-label">Transaction reference</label><input type="text" name="transaction_ref" class="form-control"></div>
          <div class="col-md-6 d-flex align-items-end"><input type="hidden" id="basePrice" name="base_price"><button class="btn btn-signup w-100">Confirm booking</button></div>
        </form>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="booking-summary p-4">
        <h3 class="fw-bold mb-3">Price summary</h3>
        <div id="priceSummary"></div>
        <div class="soft-line"></div>
        <p class="text-white-50 mb-0">Prices are displayed in BDT and update as you select a destination and passenger count.</p>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
