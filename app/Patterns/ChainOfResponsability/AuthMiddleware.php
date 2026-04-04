<?php

namespace App\Patterns\ChainOfResponsability;

class AuthMiddleware extends Handler
{
    public function handle(array $request)
    {
        if (!isset($request['user'])) {
            echo "No autenticado\n";
            return null;
        }

        echo "Usuario autenticado\n";

        return parent::handle($request);
    }
}