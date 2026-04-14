<?php

namespace App\Patterns\ChainOfResponsability;

use App\Http\Request;

class Controller extends Handler
{
    public function handle(Request $request)
    {
        echo "Ejecutando controlador\n";
        return "OK";
    }
}