<?php
require_once __DIR__ . '/../includes/functions.php';
ensure_storage();
require_admin();

require_post();
if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    flash_set('danger', 'Security check failed. Please refresh and try again.');
    redirect(app_path('admin/bookings.php'));
}

$id = trim((string)($_POST['id'] ?? ''));
if ($id !== '') {
    delete_booking($id);
    flash_set('success', 'Booking deleted.');
}

redirect(app_path('admin/bookings.php'));
