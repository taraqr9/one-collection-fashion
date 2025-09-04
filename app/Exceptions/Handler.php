<?php

namespace App\Exceptions;

use App\Models\ErrorLog;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels
        = [
            //
        ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
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
        $this->reportable(function (Throwable $e) {
            try {
                ErrorLog::create([
                    'message' => $e->getMessage(),
                    'trace' => substr($e->getTraceAsString(), 0, 2000), // store part of the trace
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'user_id' => Auth::id(),
                ]);
            } catch (\Exception $ex) {
                \Log::error('Failed to store error log: '.$ex->getMessage());
            }
        });

        $this->renderable(function (\Throwable $e, $request) {
            try {
                // Handle validation errors
                if ($e instanceof ValidationException) {
                    return redirect()
                        ->back()
                        ->withErrors($e->validator)
                        ->withInput();
                }

                // Handle unauthenticated errors (redirect to Filament login)
                if ($e instanceof AuthenticationException) {
                    if ($request->expectsJson()) {
                        return response()->json(['error' => 'Unauthenticated.'], 401);
                    }

                    // Filament’s login route is auto-registered
                    return redirect()->guest(route('filament.admin.auth.login'));
                }

                // Handle generic JSON errors
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Something went wrong. Please try again later.',
                    ], 500);
                }

                // Fallback: redirect back with error message
                return redirect()->back()->with('error', $e->getMessage());

            } catch (\Throwable $ex) {
                return parent::render($request, $e);
            }
        });

    }
}
