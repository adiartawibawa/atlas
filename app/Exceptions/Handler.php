<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function ($request, Throwable $e) {

            $response = parent::render($request, $e);

            if (!app()->environment(['local', 'testing']) && in_array($response->status(), [500, 503, 404, 403])) {
                return Inertia::render('Error', [
                    'status' => $response->status()
                ])
                    ->toResponse($request)
                    ->setStatusCode($response->status());
            } else if ($response->status() === 419) {
                return redirect()->back()->with([
                    'message' => 'The page expired, please try again.',
                ]);
            }

            return $response;
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
