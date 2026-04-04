<?php

namespace App\Patterns\ChainOfResponsability;

class Controller extends Handler
{
    public function handle(array $request)
    {
        echo "Ejecutando controlador\n";
        return "OK";
    }
}