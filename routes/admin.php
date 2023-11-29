<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::post('/auth/login', 'login');
    Route::get('/auth/logout', 'logout');
});

Route::middleware('auth')->group(function () {
    //Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Admin roles permission
//    Route::group(['prefix' => 'admins'], function () {
//        Route::get('/', [AdminController::class, 'index']);
//        Route::get('/create', [AdminController::class, 'create']);
//        Route::post('/', [AdminController::class, 'store']);
//        Route::get('/{admin}/edit', [AdminController::class, 'edit']);
//        Route::put('/{admin}', [AdminController::class, 'update']);
//        Route::get('/profile', [AdminController::class, 'profile']);
//        Route::post('/profile-update', [AdminController::class, 'profileUpdate']);
//    });


    Route::group(['prefix' => 'products'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/create', [CategoryController::class, 'create']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::get('/{category}/edit', [CategoryController::class, 'edit']);
            Route::post('/{category}/edit', [CategoryController::class, 'update']);
            Route::get('/{category}/delete', [CategoryController::class, 'delete']);
        });

        Route::group(['prefix' => 'sub_category'], function () {
            Route::get('/', [SubCategoryController::class, 'index']);
            Route::get('/create', [SubCategoryController::class, 'create']);
            Route::post('/', [SubCategoryController::class, 'store']);
            Route::get('/{sub_category}/edit', [SubCategoryController::class, 'edit']);
            Route::post('/{sub_category}/edit', [SubCategoryController::class, 'update']);
            Route::get('/{sub_category}/delete', [SubCategoryController::class, 'delete']);
        });

    });

//    Route::group(['prefix' => 'setting'], function () {
//        Route::get('/', [SettingController::class, 'index']);
//        Route::post('/', [SettingController::class, 'update']);
//    });
});





