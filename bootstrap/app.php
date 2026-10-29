<?php
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: __DIR__.'/../up',
        then: function () {
            // Load all modular role and admin route files
            Route::middleware('web')->group(base_path('routes/super_admin.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
            Route::middleware('web')->group(base_path('routes/cre.php'));
            Route::middleware('web')->group(base_path('routes/fi.php'));
            Route::middleware('web')->group(base_path('routes/operations.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
          $middleware->alias([
            'role' => CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();