<?php
$pageTitle = 'Admin Tours';
require_once __DIR__ . '/includes/header.php';
?>
<div class="admin-wrap">
  <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
  <main class="admin-content">
    <h1 class="section-title mb-4">Tours</h1>
    <div class="card-soft p-4">
      <table class="table mb-0 align-middle">
        <thead><tr><th>Title</th><th>Duration</th><th>Rating</th><th>Price</th></tr></thead>
        <tbody>
        <?php foreach (get_tours() as $tour): ?>
          <tr>
            <td><?= esc($tour['title']) ?></td>
            <td><?= esc($tour['duration']) ?></td>
            <td><?= esc($tour['rating']) ?></td>
            <td><?= esc($tour['price']) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
