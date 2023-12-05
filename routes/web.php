<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

//Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/registration', 'registrationView')->name('registration.view');
    Route::post('/registration', 'registration')->name('registration.store');
    Route::get('/login', 'loginView')->name('login')->name('login.view');
    Route::post('/auth/login', 'login')->name('login')->name('login.store');
    Route::get('/auth/logout', 'logout')->name('logout')->name('logout');
});

//Route::middleware(['web', 'auth:web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
//});


//Route::middleware('auth')->group(function () {

//});
