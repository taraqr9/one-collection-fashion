<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::resource('products', ProductController::class);
Route::get('subcategories/{category}', [CategoryController::class, 'subcategories']);

Route::middleware('web')->group(function () {
    Route::post('products/add-to-cart', [ProductController::class, 'addToCart'])->name('products.add-to-cart');
    Route::resource('carts', CartController::class)->only(['index', 'destroy']);
    Route::post('/buy-now', [CartController::class, 'buyNow'])
        ->name('carts.buy-now');
    Route::resource('orders', OrderController::class);
});
