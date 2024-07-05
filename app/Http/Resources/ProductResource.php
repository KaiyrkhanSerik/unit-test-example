<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Http\BaseJsonResource;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @property-read Product $resource
 */
final class ProductResource extends BaseJsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->resource->id,
            'name'  => $this->resource->name,
            'price' => $this->resource->price
        ];
    }
}
