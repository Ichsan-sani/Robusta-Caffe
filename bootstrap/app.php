<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'IsAdmin' => App\Http\Middleware\isAdmin::class,
            'IsKasir' => App\Http\Middleware\isKasir::class,
            'IsGuest' => App\Http\Middleware\isGuest::class,
            'IsLogin' => App\Http\Middleware\isLogin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
