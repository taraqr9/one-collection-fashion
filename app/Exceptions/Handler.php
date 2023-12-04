<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels
        = [
            //
        ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport
        = [
            //
        ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash
        = [
            'current_password',
            'password',
            'password_confirmation',
        ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $ex) {
            \Log::channel('slack')->error($ex->getMessage(), collect($ex->getTrace())->take(5)->toArray());
        });
    }

    public function render($request, Throwable $ex)
    {
        if (config('app.env') == 'production') {
            if ($request->is('api/*')) {
                return response()->fail(message: 'Something went wrong!', code: 500);
            }
        }

        return parent::render($request, $ex);
    }
}
