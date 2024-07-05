<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [ProductsController::class, 'index'])->name('v1.products.index');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('v1.products.show');
Route::post('/products', [ProductsController::class, 'store'])->name('v1.products.store');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('v1.products.update');
Route::delete('/products/{id}', [ProductsController::class, 'delete'])->name('v1.products.delete');
