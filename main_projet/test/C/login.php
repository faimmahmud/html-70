<?php
$pageTitle = 'Login';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $name = trim($_POST['name'] ?? 'Guest');
    $role = ($email === 'admin@terravista.com') ? 'admin' : 'user';

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        login_user([
            'id' => random_int(1000, 9999),
            'name' => $name ?: 'Guest',
            'email' => $email,
            'role' => $role,
        ]);
        header('Location: ' . (($_SESSION['redirect_after_login'] ?? 'dashboard.php')));
        exit;
    }
}
?>
<div class="container py-5" style="max-width:720px;">
  <h1 class="section-title mb-4">Login</h1>
  <?php if ($error): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
  <form method="post" class="card-soft p-4">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input class="form-control" name="name" placeholder="Your name">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" type="email" name="email" required>
    </div>
    <button class="btn btn-dark">Login</button>
    <div class="small text-muted mt-3">Admin demo email: admin@terravista.com</div>
  </form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
