<?php

namespace App\Patterns\ChainOfResponsability;

class LogMiddleware extends Handler
{
    public function handle(array $request)
    {
        echo "Registrando request\n";

        return parent::handle($request);
    }
}