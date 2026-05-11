<?php
$pageTitle = 'Admin Users';
require_once __DIR__ . '/includes/header.php';
?>
<div class="admin-wrap">
  <?php require_once __DIR__ . '/includes/sidebar.php'; ?>
  <main class="admin-content">
    <h1 class="section-title mb-4">Users</h1>
    <div class="card-soft p-4">
      <table class="table mb-0">
        <thead><tr><th>Name</th><th>Email</th><th>Role</th></tr></thead>
        <tbody>
        <?php foreach ($_SESSION['users'] as $u): ?>
          <tr>
            <td><?= esc($u['name']) ?></td>
            <td><?= esc($u['email']) ?></td>
            <td class="text-capitalize"><?= esc($u['role']) ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (current_user()): ?>
          <tr>
            <td><?= esc(current_user()['name']) ?></td>
            <td><?= esc(current_user()['email']) ?></td>
            <td class="text-capitalize"><?= esc(current_user()['role']) ?></td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
