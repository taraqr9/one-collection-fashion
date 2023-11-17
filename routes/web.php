<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

//Admin Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/registration', 'registrationView')->name('registration');
    Route::post('/registration', 'registration')->name('registrationStore');
    Route::get('/login', 'loginView')->name('login');
    Route::post('/auth/login', 'login');
    Route::get('/auth/logout', 'logout');
});

Route::middleware('auth')->group(function () {
    //Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
});




