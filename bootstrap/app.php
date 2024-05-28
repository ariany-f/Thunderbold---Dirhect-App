<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $middleware->appendToGroup(
            'auth',
            [\App\Http\Middleware\EnsureTenantConnection::class]
        );

        $middleware->redirectGuestsTo(function(Request $request) {
            route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
