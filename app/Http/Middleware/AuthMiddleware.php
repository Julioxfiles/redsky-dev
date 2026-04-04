<?php

namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (!$request->input('user')) {
            throw new \Exception('No autenticado');
        }

        echo "Usuario autenticado\n";
        //throw new \Exception('Usuario autenticado');
        //die();
        return $next($request);
    }
}