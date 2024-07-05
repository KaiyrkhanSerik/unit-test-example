<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\UpdateProductDTO;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'int']
        ];
    }

    public function getDto(): UpdateProductDTO
    {
        return new UpdateProductDTO($this->get('name'), $this->get('price'));
    }
}
