<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $admin_roles = json_decode(auth()->user()->roles == '' ? '[]' : auth()->user()->roles, false);
                view()->share('admin_roles', $admin_roles);
            }
        });
        Response::macro('success', function (array $data = [], string $message = 'Data successfully retrieved', int $code = 200) {
            $data['code'] = $code;
            $data['status'] = 'success';
            $data['message'] = $message;

            return response()->json($data, $code);
        });

        Response::macro('fail', function (string $message = 'Something went wrong!', int $code = 500, array $data = []) {
            $data['code'] = $code;
            $data['status'] = 'error';
            $data['message'] = $message;

            return response()->json($data, $code);
        });
    }
}
