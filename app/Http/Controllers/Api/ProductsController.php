<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\ProductsRepository;
use App\Contracts\Services\SendEmailService;
use App\Http\Controllers\Controller;
use App\Http\MessagesResource;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;

final class ProductsController extends Controller
{
    public function __construct(
      private readonly ProductsRepository $repository,
        private readonly SendEmailService $emailService
    ) {
    }

    public function index(): ProductsResource
    {
        $products = $this->repository->findAll();

        return new ProductsResource($products);
    }

    public function show(int $id): ProductResource
    {
        $product = $this->repository->findById($id);

        return new ProductResource($product);
    }

    public function store(CreateProductRequest $request): ProductResource
    {
        $product = $this->repository->create($request->getDto());

        $this->emailService->sendEmail(
            'no-reply@mechta.kz',
            'content_manager@mechta.kz',
            'Product created!'
        );

        return new ProductResource($product);
    }

    public function update(int $id, UpdateProductRequest $request): ProductResource
    {
        $dto = $request->getDto();
        $dto->setId($id);

        $product = $this->repository->update($dto);

        return (new ProductResource($product))
            ->setMessage('Product updated!');

    }

    public function delete(int $id): MessagesResource
    {
        $this->repository->delete($id);

        return (new MessagesResource(null))
            ->setMessage('Product deleted!');
    }
}
