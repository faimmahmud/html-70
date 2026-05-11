<?php

declare(strict_types=1);

namespace App\Contracts;

interface RepositoryInterface
{
    public function findById(int $id): ?object;

    public function findAll(): array;

    public function save(object $entity): bool;
}
