<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Patterns\ChainOfResponsability\AuthMiddleware;
use App\Patterns\ChainOfResponsability\LogMiddleware;
use App\Patterns\ChainOfResponsability\Controller;

class ChainController {

    public function index(Request $request){
                
        $auth = new AuthMiddleware();
        $log = new LogMiddleware();
        $controller = new Controller();

        // Building the chain - Construcción de la cadena
        $auth->setNext($log)->setNext($controller);
                
        // Execution - Ejecución
        // Request - Solicitud
        $response = $auth->handle($request);
        echo $response;
    }

}