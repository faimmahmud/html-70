<?php

declare(strict_types=1);

namespace App\Models;

final class User extends AbstractEntity
{
    public function __construct(
        ?int $id,
        private string $name,
        private string $email,
        private string $passwordHash,
        private string $role = 'user',
        private ?string $createdAt = null
    ) {
        parent::__construct($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->passwordHash,
            'role' => $this->role,
            'created_at' => $this->createdAt,
        ];
    }
}
