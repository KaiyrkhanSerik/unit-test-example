<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\DTO\CreateProductDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductsRepository
{
    public function findAll(): Collection;

    public function findById(int $id): ?Product;

    public function create(CreateProductDTO $dto): Product;

    public function update(\App\DTO\UpdateProductDTO $dto): Product;

    public function delete(int $id): void;
}
