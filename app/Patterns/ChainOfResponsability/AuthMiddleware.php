<?php

namespace App\Patterns\ChainOfResponsability;

use App\Http\Request;

class AuthMiddleware extends Handler
{
    public function handle(Request $request)
    {
        if (!$request->input('user')) {
            echo "No autenticado\n";
            return null;
        }

        echo "Usuario autenticado\n";

        return parent::handle($request);
    }
}