<?php

namespace App\Http\Controllers;

use App\Patterns\Facade\AuthService;
use App\Patterns\Facade\Database;
use App\Patterns\Facade\Logger;
use App\Patterns\Facade\LoginFacade;

class FacadeController {

    public function index() {
        title("Without Facade");
        $auth = new AuthService();
        $db = new Database();
        $logger = new Logger();
        $db->connect();
        $auth->authenticate("Julio","1234");
        $logger->log("Usuario autenticado");      

    }

    public function withFacade(){
        title("With Facade (Fachada)");
        $facade = new LoginFacade();
        $facade->login("admin", "1234");

    }
}
