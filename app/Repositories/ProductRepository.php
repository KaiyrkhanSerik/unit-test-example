<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductsRepository;
use App\DTO\CreateProductDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

final class ProductRepository implements ProductsRepository
{
    public function findAll(): Collection
    {
        return Product::query()->get();
    }

    public function findById(int $id): ?Product
    {
        /** @var ?Product $product */
        $product = Product::query()
            ->find($id);

        return $product;
    }

    public function create(CreateProductDTO $dto): Product
    {
        /** @var Product $product */
        $product = Product::query()
            ->create([
                'name'  => $dto->name,
                'price' => $dto->price
            ]);

        return $product;
    }

    public function update(\App\DTO\UpdateProductDTO $dto): Product
    {
        /** @var Product $product */
        $product = Product::query()
            ->where('id', $dto->getId())
            ->first();

        $product->update([
            'name'  => $dto->name,
            'price' => $dto->price
        ]);

        return $product;
    }

    /**
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        /** @var Product $product */
        $product = Product::query()
            ->where('id', $id)
            ->first();

        $product->deleteOrFail();
    }
}
