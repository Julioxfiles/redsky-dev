<?php

namespace App\Http\Middleware;

class LogMiddleware
{
    public function handle($request, $next)
    {
        echo "Registrando request\n";
        return $next($request);
    }
}