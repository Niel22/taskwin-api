<?php

use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\PromoterAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1'
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'json' => ForceJsonResponse::class,
            'admin' => AdminAccess::class,
            'promoter' => PromoterAccess::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
    })->create();
