<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['user.header', 'user.footer', 'user.home'], function ($view) {
            $settings = cache()->rememberForever('settings.all', fn () => Setting::all());
            $view->with('settings', $settings);
        });
    }
}
