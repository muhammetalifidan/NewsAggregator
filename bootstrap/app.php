<?php

use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->appendToGroup('api', [StartSession::class]);
        $middleware->alias([
            'auth.admin' => AuthenticateAdmin::class,
            'auth.admin.guest' => RedirectIfAdminAuthenticated::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
