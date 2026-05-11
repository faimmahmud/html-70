<?php
$pageTitle = 'Admin Bookings';
require_once __DIR__ . '/includes/header.php';
?>
<div class="admin-wrap">
  <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
  <main class="admin-content">
    <h1 class="section-title mb-4">Bookings</h1>
    <div class="card-soft p-4">
      <?php if (empty($_SESSION['bookings'])): ?>
        <div class="text-muted">No bookings yet.</div>
      <?php else: ?>
        <table class="table mb-0">
          <thead><tr><th>User</th><th>Tour</th><th>Date</th><th>Travellers</th><th>Created</th></tr></thead>
          <tbody>
          <?php foreach ($_SESSION['bookings'] as $b): ?>
            <tr>
              <td><?= esc($b['name']) ?></td>
              <td><?= esc($b['tour']) ?></td>
              <td><?= esc($b['date']) ?></td>
              <td><?= esc((string)$b['travellers']) ?></td>
              <td><?= esc($b['time']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </main>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
