<?php
$pageTitle = 'Services | Fly Soul';
$pageDescription = 'Hotels, tours, chauffeur-drive, meet & greet, and airport transfers.';
$activePage = 'experiences';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';

$type = $_GET['type'] ?? 'hotels';
if (!isset($servicePackages[$type])) {
    $type = 'hotels';
}
$serviceIndex = array_search($type, array_column($services, 'type'), true);
$selectedService = $serviceIndex !== false ? $services[$serviceIndex] : $services[0];
?>

<section class="inner-hero">
  <div class="container">
    <div class="section-pill mb-3">Services</div>
    <h1 class="section-title mb-2"><?= htmlspecialchars($selectedService['title']) ?></h1>
    <p class="mb-0"><?= htmlspecialchars($selectedService['short']) ?></p>
  </div>
</section>

<section class="container py-4 py-lg-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="section-card mb-4">
        <div class="row g-3">
          <?php foreach ($services as $s): ?>
            <div class="col-md-6 col-lg-4">
              <a href="services.php?type=<?= urlencode($s['type']) ?>" class="text-dark">
                <div class="service-mini h-100 <?= $type === $s['type'] ? 'border border-2 border-primary' : '' ?>">
                  <div class="icon"><?= $s['icon'] ?></div>
                  <div>
                    <div class="fw-bold"><?= htmlspecialchars($s['title']) ?></div>
                    <div class="mini-text"><?= htmlspecialchars($s['subtitle']) ?></div>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="card-list">
        <?php foreach ($servicePackages[$type] as $item): ?>
          <div class="list-item d-flex justify-content-between align-items-start gap-3">
            <div>
              <h5 class="mb-1"><?= htmlspecialchars($item['title']) ?></h5>
              <div class="mini-text"><?= htmlspecialchars($item['desc']) ?></div>
            </div>
            <div class="text-end">
              <div class="price">BDT <?= number_format($item['price']) ?></div>
              <div class="mini-text">starting</div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="booking-summary p-4">
        <div class="section-pill mb-3">Book service</div>
        <h3 class="fw-bold mb-2">Easy service request</h3>
        <p class="text-white-50">Choose a service and submit your request in seconds.</p>
        <form id="serviceForm" class="row g-3 mt-1">
          <input type="hidden" name="service_type" value="<?= htmlspecialchars($type) ?>">
          <div class="col-12"><input class="form-control" name="full_name" placeholder="Full name" required></div>
          <div class="col-12"><input class="form-control" name="email" placeholder="Email" type="email" required></div>
          <div class="col-12"><input class="form-control" name="phone" placeholder="Phone" required></div>
          <div class="col-12"><input class="form-control" name="travel_date" type="date"></div>
          <div class="col-12"><textarea class="form-control" name="details" rows="4" placeholder="Tell us what you need" required></textarea></div>
          <div class="col-12" id="serviceAlert"></div>
          <div class="col-12"><button class="btn btn-signup w-100">Send request</button></div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
