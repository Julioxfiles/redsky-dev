<?php

namespace App\Patterns\ChainOfResponsability;

use App\Http\Request;

class LogMiddleware extends Handler
{
    public function handle(Request $request)
    {
        echo "Registrando request\n";

        return parent::handle($request);
    }
}