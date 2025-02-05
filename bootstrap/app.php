<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web', [
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Menambahkan cookies ke response
            \Illuminate\Session\Middleware\AuthenticateSession::class, // Autentikasi session
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Menyebarkan error session ke view
           // \Inertia\Middleware::class,
           \App\Http\Middleware\HandleInertiaRequests::class,

        ]);

        $middleware->group('api', [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            
        ]);

        $middleware->alias([
            'canAccess' => App\Http\Middleware\CanAccess::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
