<?php
require_once __DIR__ . '/../includes/functions.php';
ensure_storage();
require_admin();

require_post();
if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    flash_set('danger', 'Security check failed. Please refresh and try again.');
    redirect(app_path('admin/index.php'));
}

$id = trim((string)($_POST['id'] ?? ''));
if ($id !== '') {
    $packages = read_packages();
    $packages = array_values(array_filter($packages, fn($pkg) => (string)($pkg['id'] ?? '') !== $id));
    write_packages($packages);
    flash_set('success', 'Package deleted.');
}
redirect(app_path('admin/index.php'));
