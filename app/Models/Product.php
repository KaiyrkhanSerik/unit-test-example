<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
final class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    protected static function newFactory(): ProductFactory
    {
        Auth::id();
        return ProductFactory::new();
    }
}
