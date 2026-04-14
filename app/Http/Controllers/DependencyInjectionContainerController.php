<?php

namespace App\Http\Controllers;

use App\Patterns\DependencyInjectionContainer\Container;
use App\Patterns\DependencyInjectionContainer\UserController;

class DependencyInjectionContainerController {

    public function index() {

        $container = new Container();
        $controller = $container->make(UserController::class);
        print_r($controller->index());

    }

}