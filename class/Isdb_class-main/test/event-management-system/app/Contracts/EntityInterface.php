<?php

declare(strict_types=1);

namespace App\Contracts;

interface EntityInterface
{
    public function getId(): ?int;

    public function toArray(): array;
}
