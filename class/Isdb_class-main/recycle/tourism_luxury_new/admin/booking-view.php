<?php
require_once __DIR__ . '/../includes/functions.php';
ensure_storage();
if (!is_admin()) {
    flash_set('danger', 'Admin access required.');
    redirect(app_path('login.php'));
}

$id = trim((string)($_GET['id'] ?? ($_POST['id'] ?? '')));
$booking = find_booking_by_id($id);
if (!$booking) {
    flash_set('danger', 'Booking not found.');
    redirect(app_path('admin/bookings.php'));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'booking_status' => trim($_POST['booking_status'] ?? $booking['booking_status']),
        'payment_status' => trim($_POST['payment_status'] ?? $booking['payment_status']),
        'payment_method' => trim($_POST['payment_method'] ?? $booking['payment_method']),
        'payment_reference' => trim($_POST['payment_reference'] ?? $booking['payment_reference']),
        'booking_type' => trim($_POST['booking_type'] ?? $booking['booking_type']),
        'package_name' => trim($_POST['package_name'] ?? $booking['package_name']),
        'package_id' => trim($_POST['package_id'] ?? $booking['package_id']),
        'country' => trim($_POST['country'] ?? $booking['country']),
        'departure_from' => trim($_POST['departure_from'] ?? $booking['departure_from']),
        'destination' => trim($_POST['destination'] ?? $booking['destination']),
        'travel_date' => trim($_POST['travel_date'] ?? $booking['travel_date']),
        'travel_time' => trim($_POST['travel_time'] ?? $booking['travel_time']),
        'leave_date' => trim($_POST['leave_date'] ?? $booking['leave_date']),
        'leave_time' => trim($_POST['leave_time'] ?? $booking['leave_time']),
        'guests' => (int)($_POST['guests'] ?? $booking['guests']),
        'amount' => parse_amount($_POST['amount'] ?? $booking['amount']),
        'currency' => trim($_POST['currency'] ?? $booking['currency']),
        'message' => trim($_POST['message'] ?? $booking['message']),
    ];
    update_booking($id, $data);
    flash_set('success', 'Booking updated successfully.');
    redirect(app_path('admin/booking-view.php?id=' . $id));
}

$pageTitle = 'Booking Details | ' . $site['brand'];
require_once __DIR__ . '/../includes/header.php';

function badge_style(string $status): string {
    return match (strtolower($status)) {
        'pending' => 'warning text-dark',
        'confirmed' => 'success',
        'completed' => 'primary',
        'cancelled' => 'danger',
        'failed' => 'danger',
        'paid' => 'success',
        'refunded' => 'secondary',
        default => 'secondary',
    };
}
?>
<section class="arc-section mt-0">
  <div class="container">
    <div class="surface p-4 p-lg-5 rounded-5 reveal mb-4">
      <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
        <div>
          <div class="section-kicker">Booking details</div>
          <h1 class="section-title mb-2"><?= e($booking['booking_ref']) ?></h1>
          <p class="section-lead mb-0"><?= e($booking['customer_name']) ?> • <?= e($booking['package_name']) ?></p>
        </div>
        <div class="d-flex flex-wrap gap-2">
          <a href="<?= e(app_path('admin/bookings.php')) ?>" class="btn btn-outline-dark px-4">Back</a>
          <form method="post" action="<?= e(app_path('admin/booking-delete.php')) ?>" onsubmit="return confirm('Delete this booking?');">
            <input type="hidden" name="id" value="<?= e((string)$booking['id']) ?>">
            <button class="btn btn-danger px-4">Delete</button>
          </form>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="surface p-4 rounded-5 reveal h-100">
          <h3 class="h4 fw-bold mb-3">Customer</h3>
          <p class="mb-2"><strong>Name:</strong> <?= e($booking['customer_name']) ?></p>
          <p class="mb-2"><strong>Email:</strong> <?= e($booking['customer_email']) ?></p>
          <p class="mb-2"><strong>Phone:</strong> <?= e($booking['customer_phone']) ?></p>
          <p class="mb-2"><strong>Booked by:</strong> <?= e($booking['booked_by']) ?> (<?= e($booking['booked_role']) ?>)</p>
          <p class="mb-2"><strong>IP:</strong> <?= e($booking['ip_address']) ?></p>
          <p class="mb-0"><strong>User agent:</strong> <?= e($booking['user_agent']) ?></p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="surface p-4 rounded-5 reveal h-100">
          <h3 class="h4 fw-bold mb-3">Trip</h3>
          <p class="mb-2"><strong>Type:</strong> <?= e($booking['booking_type']) ?></p>
          <p class="mb-2"><strong>Package:</strong> <?= e($booking['package_name']) ?></p>
          <p class="mb-2"><strong>Package ID:</strong> <?= e($booking['package_id'] ?: '—') ?></p>
          <p class="mb-2"><strong>Country:</strong> <?= e($booking['country'] ?: '—') ?></p>
          <p class="mb-2"><strong>From:</strong> <?= e($booking['departure_from'] ?: '—') ?></p>
          <p class="mb-2"><strong>Destination:</strong> <?= e($booking['destination'] ?: '—') ?></p>
          <p class="mb-2"><strong>Travel:</strong> <?= e($booking['travel_date']) ?> at <?= e($booking['travel_time']) ?></p>
          <p class="mb-0"><strong>Leave:</strong> <?= e($booking['leave_date']) ?> at <?= e($booking['leave_time']) ?></p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="surface p-4 rounded-5 reveal h-100">
          <h3 class="h4 fw-bold mb-3">Payment & status</h3>
          <p class="mb-2"><strong>Amount:</strong> <?= e($booking['currency']) ?> <?= e(number_format((float)$booking['amount'], 2)) ?></p>
          <p class="mb-2"><strong>Method:</strong> <?= e($booking['payment_method']) ?></p>
          <p class="mb-2"><strong>Reference:</strong> <?= e($booking['payment_reference'] ?: '—') ?></p>
          <p class="mb-2"><strong>Booking status:</strong> <span class="badge rounded-pill bg-<?= e(badge_style($booking['booking_status'])) ?>"><?= e($booking['booking_status']) ?></span></p>
          <p class="mb-2"><strong>Payment status:</strong> <span class="badge rounded-pill bg-<?= e(badge_style($booking['payment_status'])) ?>"><?= e($booking['payment_status']) ?></span></p>
          <p class="mb-0"><strong>Created:</strong> <?= e($booking['created_at']) ?></p>
        </div>
      </div>
    </div>

    <div class="surface p-4 p-lg-5 rounded-5 reveal mt-4">
      <h3 class="h4 fw-bold mb-3">Edit booking</h3>
      <form method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= e((string)$booking['id']) ?>">
        <div class="col-md-4">
          <label class="form-label">Booking status</label>
          <select name="booking_status" class="form-select">
            <?php foreach (['pending','confirmed','completed','cancelled'] as $opt): ?>
              <option value="<?= e($opt) ?>" <?= $booking['booking_status'] === $opt ? 'selected' : '' ?>><?= e(ucfirst($opt)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Payment status</label>
          <select name="payment_status" class="form-select">
            <?php foreach (['pending','paid','refunded','failed'] as $opt): ?>
              <option value="<?= e($opt) ?>" <?= $booking['payment_status'] === $opt ? 'selected' : '' ?>><?= e(ucfirst($opt)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Payment method</label>
          <select name="payment_method" class="form-select">
            <?php foreach (['cash','bkash','nagad','rocket','card','bank','paypal'] as $opt): ?>
              <option value="<?= e($opt) ?>" <?= $booking['payment_method'] === $opt ? 'selected' : '' ?>><?= e(ucfirst($opt)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4"><label class="form-label">Booking type</label><input class="form-control" name="booking_type" value="<?= e($booking['booking_type']) ?>"></div>
        <div class="col-md-8"><label class="form-label">Package / ticket name</label><input class="form-control" name="package_name" value="<?= e($booking['package_name']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Package ID</label><input class="form-control" name="package_id" value="<?= e($booking['package_id']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Country / route</label><input class="form-control" name="country" value="<?= e($booking['country']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Amount</label><input class="form-control" name="amount" value="<?= e((string)$booking['amount']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Currency</label><input class="form-control" name="currency" value="<?= e($booking['currency']) ?>"></div>
        <div class="col-md-6"><label class="form-label">Departure from</label><input class="form-control" name="departure_from" value="<?= e($booking['departure_from']) ?>"></div>
        <div class="col-md-6"><label class="form-label">Destination</label><input class="form-control" name="destination" value="<?= e($booking['destination']) ?>"></div>
        <div class="col-md-3"><label class="form-label">Travel date</label><input type="date" class="form-control" name="travel_date" value="<?= e($booking['travel_date']) ?>"></div>
        <div class="col-md-3"><label class="form-label">Travel time</label><input type="time" class="form-control" name="travel_time" value="<?= e($booking['travel_time']) ?>"></div>
        <div class="col-md-3"><label class="form-label">Leave date</label><input type="date" class="form-control" name="leave_date" value="<?= e($booking['leave_date']) ?>"></div>
        <div class="col-md-3"><label class="form-label">Leave time</label><input type="time" class="form-control" name="leave_time" value="<?= e($booking['leave_time']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Guests / tickets</label><input type="number" min="1" class="form-control" name="guests" value="<?= e((string)$booking['guests']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Payment reference</label><input class="form-control" name="payment_reference" value="<?= e($booking['payment_reference']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Booked by</label><input class="form-control" name="booked_by" value="<?= e($booking['booked_by']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Booked role</label><input class="form-control" name="booked_role" value="<?= e($booking['booked_role']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Channel</label><input class="form-control" name="booking_channel" value="<?= e($booking['booking_channel']) ?>"></div>
        <div class="col-md-4"><label class="form-label">IP address</label><input class="form-control" name="ip_address" value="<?= e($booking['ip_address']) ?>"></div>
        <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="4"><?= e($booking['message']) ?></textarea></div>
        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
