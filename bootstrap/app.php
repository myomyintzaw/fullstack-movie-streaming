<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then:function(){
            // Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(__DIR__.'/../routes/admin.php');
            Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')
            ->name('admin.')
            ->middleware('web')
            ->group(base_path('/routes/admin.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'RedirectIfAdminAuth' => App\Http\Middleware\RedirectIfAdminAuth::class,
            'RedirectIfNotAdminAuth' => App\Http\Middleware\RedirectIfNotAdminAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
