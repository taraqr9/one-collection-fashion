<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MidBannerController;
use App\Http\Controllers\Admin\MiniBottomBannerController;
use App\Http\Controllers\Admin\MiniTopBannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TopBannerController;
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
    Route::group(['prefix' => 'admins'], function () {
        //        Route::get('/', [AdminController::class, 'index']);
        //        Route::get('/create', [AdminController::class, 'create']);
        //        Route::post('/', [AdminController::class, 'store']);
        //        Route::get('/{admin}/edit', [AdminController::class, 'edit']);
        //        Route::put('/{admin}', [AdminController::class, 'update']);
        Route::get('/profile', [AdminController::class, 'profile']);
        Route::post('/profile-update', [AdminController::class, 'profileUpdate']);
    });

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
            Route::get('/{sub_category_id}', [SubCategoryController::class, 'getSubcategories']);
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::get('/create', [ProductController::class, 'create']);
            Route::post('/', [ProductController::class, 'store']);
            Route::get('/{product}/edit', [ProductController::class, 'edit']);
            Route::post('/{product}/edit', [ProductController::class, 'update']);
            Route::get('/{product}/delete', [ProductController::class, 'delete']);
            Route::get('/{product}/{type}/{index}/delete', [ProductController::class, 'colorDelete']);
        });

    });

    Route::group(['prefix' => 'settings'], function () {

        Route::group(['prefix' => 'top_banner'], function () {
            Route::get('/', [TopBannerController::class, 'index']);
            Route::post('/', [TopBannerController::class, 'store']);
            Route::post('/{banner}/edit', [TopBannerController::class, 'update']);
            Route::get('/{banner}/delete', [TopBannerController::class, 'delete'])->name('settings.top_banner.delete');
        });

        Route::group(['prefix' => 'mid_banner'], function () {
            Route::get('/', [MidBannerController::class, 'index'])->name('settings.mid_banner.index');
            Route::post('/', [MidBannerController::class, 'store'])->name('settings.mid_banner.create');
            Route::post('/{banner}/edit', [MidBannerController::class, 'update'])->name('settings.mid_banner');
            Route::get('/{banner}/delete', [MidBannerController::class, 'delete'])->name('settings.mid_banner.delete');
        });

        Route::group(['prefix' => 'mini_top_banner'], function () {
            Route::get('/', [MiniTopBannerController::class, 'index'])->name('settings.mini_top_banner.index');
            Route::post('/', [MiniTopBannerController::class, 'store'])->name('settings.mini_top_banner.create');
            Route::post('/{banner}/edit', [MiniTopBannerController::class, 'update'])->name('settings.mini_top_banner');
            Route::get('/{banner}/delete', [MiniTopBannerController::class, 'delete'])->name('settings.mini_top_banner.delete');
        });

        Route::group(['prefix' => 'mini_bottom_banner'], function () {
            Route::get('/', [MiniBottomBannerController::class, 'index'])->name('settings.mini_bottom_banner.index');
            Route::post('/', [MiniBottomBannerController::class, 'store'])->name('settings.mini_bottom_banner.create');
            Route::post('/{banner}/edit', [MiniBottomBannerController::class, 'update'])->name('settings.mini_bottom_banner');
            Route::get('/{banner}/delete', [MiniBottomBannerController::class, 'delete'])->name('settings.mini_bottom_banner.delete');
        });

        Route::group(['prefix' => 'footer'], function () {
            Route::get('/', [FooterController::class, 'index'])->name('footer');
            Route::get('/{type}/create', [FooterController::class, 'create'])->name('footer.create');
            Route::post('/', [FooterController::class, 'storeOrUpdate'])->name('footer.store');
            Route::get('/{type}/details', [FooterController::class, 'details'])->name('footer.details');
        });

    });
});
