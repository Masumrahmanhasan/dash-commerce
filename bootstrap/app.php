<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AccessDeniedHttpException $exception, $request) {
            return $request->expectsJson()
                ? response()->json([
                    'status' => 403,
                    'message' => $exception->getMessage()
                ], 403)
                : back()->with('error', $exception->getMessage());
        });

        $exceptions->render(function (NotFoundHttpException $exception, $request) {
            return $request->expectsJson()
                ? response()->json([
                    'status' => 404,
                    'message' => $exception->getMessage()
                ], 404)
                : back()->with('error', $exception->getMessage());
        });
    })->create();
