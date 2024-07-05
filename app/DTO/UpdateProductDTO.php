<?php

declare(strict_types=1);

namespace App\DTO;

final class UpdateProductDTO
{
    private int $id;
    public function __construct(
        public readonly string $name,
        public readonly int $price
    ) {
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
