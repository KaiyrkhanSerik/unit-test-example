<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\CreateProductDTO;
use Illuminate\Foundation\Http\FormRequest;

final class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'int']
        ];
    }

    public function getDto(): CreateProductDTO
    {
        return new CreateProductDTO($this->post('name'), (int)$this->post('price'));
    }
}
