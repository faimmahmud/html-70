<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\EntityInterface;

abstract class AbstractEntity implements EntityInterface
{
    protected ?int $id;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
