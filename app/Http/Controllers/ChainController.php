<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Patterns\ChainOfResponsability\AuthMiddleware;
use App\Patterns\ChainOfResponsability\LogMiddleware;
use App\Patterns\ChainOfResponsability\Controller;

class ChainController {

    public function index(Request $request){
        // Request - Solicitud
        $user = $request->input('user');

        $auth = new AuthMiddleware();
        $log = new LogMiddleware();
        $controller = new Controller();

        // Building the chain - Construcción de la cadena
        $auth->setNext($log)->setNext($controller);
                
        // Execution - Ejecución
        $response = $auth->handle($user);
        echo $response;
    }

}