<?php

namespace App\Http\Middleware;

class MiddlewareRegistry
{
    public static function get(string $key): string
    {
        return [
            'auth.custom' => \App\Http\Middleware\AuthMiddleware::class,
            'log' => \App\Http\Middleware\LogMiddleware::class,
        ][$key] ?? throw new \Exception("Middleware not found: $key");
    }
}