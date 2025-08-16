<?php

use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);

Route::get('/subcategories/{category}', [CategoryController::class, 'subcategories']);

Route::group(['prefix' => 'products'], function () {
    Route::get('/list', [ProductController::class, 'list']);
    Route::get('/detail', [ProductController::class, 'detail']);
    Route::get('/checkout', [ProductController::class, 'checkout']);
    Route::get('/cart', [ProductController::class, 'cart']);
});
