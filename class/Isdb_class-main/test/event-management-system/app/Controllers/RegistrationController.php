<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use Throwable;

final class RegistrationController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function show(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $this->view('register', [
            'title' => 'Register',
            'csrf' => $_SESSION['csrf'],
            'error' => null,
            'success' => null,
        ]);
    }

    public function store(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $token = $_POST['_token'] ?? '';

        if (!hash_equals($_SESSION['csrf'] ?? '', (string) $token)) {
            http_response_code(403);
            exit('Invalid CSRF token.');
        }

        try {
            $this->authService->register($_POST);
            $_SESSION['flash_success'] = 'Registration completed successfully.';
            header('Location: /register');
            exit;
        } catch (Throwable $e) {
            $_SESSION['flash_error'] = $e->getMessage();
            header('Location: /register');
            exit;
        }
    }
}
