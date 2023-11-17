<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CardAreaController;
use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\CareerBannerController;
use App\Http\Controllers\CardCounterController;
use App\Http\Controllers\CardDivisionController;
use App\Http\Controllers\CardHelpRequestController;
use App\Http\Controllers\CareerDepartmentController;
use App\Http\Controllers\CareerJobController;
use App\Http\Controllers\SettingController;
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


//    Route::group(['prefix' => 'cards'], function () {
//        Route::group(['prefix' => 'division'], function () {
//            Route::get('/', [CardDivisionController::class, 'index']);
//            Route::get('/create', [CardDivisionController::class, 'create']);
//            Route::post('/', [CardDivisionController::class, 'store']);
//            Route::get('/{division}', [CardDivisionController::class, 'getDivisionWiseAreas']);
//            Route::get('/{division}/edit', [CardDivisionController::class, 'edit']);
//            Route::post('/{division}/edit', [CardDivisionController::class, 'update']);
//        });
//    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/', [SettingController::class, 'update']);
    });
});





