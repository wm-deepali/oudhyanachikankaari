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

        // Meta Pixel ki cookies JavaScript set karta hai (Laravel nahi), isliye inhe
        // decrypt karne ki koshish na ho. Warna $request->cookie('_fbp') / ('_fbc') null aata hai.
        $middleware->encryptCookies(except: [
            '_fbp',
            '_fbc',
        ]);

        $middleware->alias([
            'customer' => \App\Http\Middleware\CustomerAuth::class,
            'maintenance.mode' => \App\Http\Middleware\MaintenanceModeMiddleware::class,
            'admin.timeout' => \App\Http\Middleware\AdminSessionTimeout::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\NoCacheHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();