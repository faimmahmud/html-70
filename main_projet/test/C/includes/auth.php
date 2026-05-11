<?php
require_once __DIR__ . '/../config/config.php';

function is_logged_in(): bool
{
    return !empty($_SESSION['user']);
}

function is_admin(): bool
{
    return is_logged_in() && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function current_user(): ?array
{
    return is_logged_in() ? $_SESSION['user'] : null;
}

function login_user(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
}

function logout_user(): void
{
    unset($_SESSION['user']);
}

function require_login(string $redirect = 'login.php'): void
{
    if (!is_logged_in()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? 'dashboard.php';
        header('Location: ' . BASE_URL . '/' . ltrim($redirect, '/'));
        exit;
    }
}

function require_admin(): void
{
    require_login('login.php');
    if (!is_admin()) {
        header('Location: ' . BASE_URL . '/dashboard.php');
        exit;
    }
}
