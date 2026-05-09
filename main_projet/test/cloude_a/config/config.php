<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('SITE_NAME', 'Terra Vista');
define('SITE_TAGLINE', 'World-class tourism experiences');
define('BASE_URL', '');

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'name' => 'Admin', 'email' => 'admin@terravista.com', 'role' => 'admin'],
    ];
}

if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [];
}
