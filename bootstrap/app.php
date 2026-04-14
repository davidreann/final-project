<?php

use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (PostTooLargeException $exception, $request) {
            $message = 'Cannot upload past 5MB. Please choose an image smaller than 5MB.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 413);
            }

            return back()->withErrors(['image' => $message]);
        });
    })->create();
