<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'registrationView'])->name('register');
Route::post('register', [AuthController::class, 'registration'])->name('register');
Route::resource('products', ProductController::class);
Route::get('subcategories/{category}', [CategoryController::class, 'subcategories']);

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('products/add-to-cart', [ProductController::class, 'addToCart'])->name('products.add-to-cart');
    Route::post('/buy-now', [CartController::class, 'buyNow'])->name('carts.buy-now');
    Route::resource('carts', CartController::class)->only(['index', 'destroy']);
    Route::resource('orders', OrderController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
