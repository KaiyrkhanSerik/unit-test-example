<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JsonSerializable;

final class ProductsResource extends BaseResourceCollection
{
    public function toArray(Request $request): AnonymousResourceCollection|array|JsonSerializable|Arrayable
    {
        return ProductResource::collection($this->collection);
    }
}
