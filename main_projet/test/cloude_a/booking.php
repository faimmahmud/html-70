<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
require_login('login.php');

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tour = trim($_POST['tour'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $travellers = (int)($_POST['travellers'] ?? 1);

    $_SESSION['bookings'][] = [
        'name' => current_user()['name'] ?? 'Guest',
        'tour' => $tour,
        'date' => $date,
        'travellers' => max(1, $travellers),
        'time' => date('Y-m-d H:i'),
    ];
    $message = 'Booking saved in your session.';
}
?>
<div class="container py-5" style="max-width:900px;">
  <h1 class="section-title mb-4">Booking</h1>
  <?php if ($message): ?><div class="alert alert-success"><?= esc($message) ?></div><?php endif; ?>
  <form method="post" class="card-soft p-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Tour name</label>
        <select name="tour" class="form-select" required>
          <option value="">Choose one</option>
          <?php foreach (get_tours() as $tour): ?>
            <option value="<?= esc($tour['title']) ?>"><?= esc($tour['title']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Travel date</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Travellers</label>
        <input type="number" name="travellers" class="form-control" min="1" value="1" required>
      </div>
    </div>
    <button class="btn btn-dark mt-4">Save Booking</button>
  </form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
