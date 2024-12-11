<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', // Thêm route API
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )

    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (Throwable $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => $e->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
        });
    })->create();
