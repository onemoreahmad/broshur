<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: [
            __DIR__.'/../routes/api.php',
        ],
        web: [
            __DIR__.'/../routes/web.php', 
            __DIR__.'/../routes/auth.php', 
            __DIR__.'/../routes/dashboard.php', 
            __DIR__.'/../routes/admin.php', 
            __DIR__.'/../routes/tenant.php'
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
        // $middleware->validateCsrfTokens();

        $middleware->redirectGuestsTo(function ($request) {
            return route('auth.login');
        });
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'currentBroshur' => \App\Http\Middleware\CurrentBroshur::class,
        ]);

       
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
