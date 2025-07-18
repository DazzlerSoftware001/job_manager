<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\RecruiterMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MaintenanceMiddleware;
use App\Http\Middleware\CheckInstallation;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user' => UserMiddleware::class,
            'recruiter' => RecruiterMiddleware::class,
            'admin' => AdminMiddleware::class,
            'maintenance' => MaintenanceMiddleware::class,
            'installed' => CheckInstallation::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
