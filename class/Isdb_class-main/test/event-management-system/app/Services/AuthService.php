<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use InvalidArgumentException;

final class AuthService
{
    public function __construct(private UserRepository $users)
    {
    }

    public function register(array $input): User
    {
        $name = trim((string) ($input['name'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $confirmPassword = (string) ($input['confirm_password'] ?? '');

        if ($name === '' || $email === '' || $password === '' || $confirmPassword === '') {
            throw new InvalidArgumentException('All fields are required.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address.');
        }

        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters.');
        }

        if ($password !== $confirmPassword) {
            throw new InvalidArgumentException('Passwords do not match.');
        }

        if ($this->users->findByEmail($email)) {
            throw new InvalidArgumentException('Email already exists.');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(null, $name, $email, $hash, 'user');
        $this->users->save($user);

        return $user;
    }
}
