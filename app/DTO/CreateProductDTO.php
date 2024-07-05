<?php

declare(strict_types=1);

namespace App\DTO;

final class CreateProductDTO
{
    public function __construct(
      public readonly string $name,
      public readonly int $price
    ) {
    }
}
