<?php ob_start(); ?>

<div class="container py-5 min-vh-100 d-flex align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6">
            <div class="premium-card p-4 p-md-5">
                <h1 class="fw-bold mb-2">Create your account</h1>
                <p class="text-white-75 mb-4">Secure registration for event organizers and guests.</p>

                <?php if (!empty($_SESSION['flash_error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['flash_error'], ENT_QUOTES, 'UTF-8') ?></div>
                    <?php unset($_SESSION['flash_error']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['flash_success'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success'], ENT_QUOTES, 'UTF-8') ?></div>
                    <?php unset($_SESSION['flash_success']); ?>
                <?php endif; ?>

                <form method="POST" action="/register" class="row g-3">
                    <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="col-12">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-warning btn-lg w-100 rounded-pill fw-semibold">Register Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
