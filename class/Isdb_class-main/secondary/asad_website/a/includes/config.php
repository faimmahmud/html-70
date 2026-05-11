<?php
// Basic configuration. Replace with your actual database credentials.
define('APP_NAME', 'Aurelia Estates');
define('APP_URL', 'http://localhost/real-estate-platform');

$DB_HOST = 'localhost';
$DB_NAME = 'real_estate';
$DB_USER = 'root';
$DB_PASS = '';

function db_connect() {
    global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS;
    try {
        $pdo = new PDO(
            "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
            $DB_USER,
            $DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}
?>
