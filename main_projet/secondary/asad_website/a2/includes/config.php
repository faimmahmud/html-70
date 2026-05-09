<?php
// Flat PHP app config

define('APP_NAME', 'Aurelia Estates');
define('APP_URL', getenv('APP_URL') ?: 'http://localhost:8000');
define('APP_TZ', 'Asia/Dhaka');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'real_estate');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

define('UPLOAD_DIR', __DIR__ . '/../uploads');
define('PROPERTY_UPLOAD_DIR', UPLOAD_DIR . '/properties');
define('AVATAR_UPLOAD_DIR', UPLOAD_DIR . '/avatars');

define('DEFAULT_CURRENCY', 'USD');

define('PAYMENT_PROVIDERS', 'sslcommerz,bkash,nagad');
