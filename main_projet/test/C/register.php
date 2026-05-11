<?php
$pageTitle = 'Register';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please complete the form correctly.';
    } else {
        login_user([
            'id' => random_int(1000, 9999),
            'name' => $name,
            'email' => $email,
            'role' => 'user',
        ]);
        header('Location: dashboard.php');
        exit;
    }
}
?>
<div class="container py-5" style="max-width:720px;">
  <h1 class="section-title mb-4">Register</h1>
  <?php if ($error): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
  <form method="post" class="card-soft p-4">
    <div class="mb-3"><label class="form-label">Full name</label><input class="form-control" name="name" required></div>
    <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required></div>
    <button class="btn btn-dark">Create account</button>
  </form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
