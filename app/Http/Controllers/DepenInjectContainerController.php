<?php

namespace App\Patterns\DependencyInjectionContainer;

use App\Patterns\DependencyInjectionContainer\Container;
use App\Patterns\DependencyInjectionContainer\UserController;

class DepenInjectContainerController {

    public function index() {

        $container = new Container();
        $controller = $container->make(UserController::class);
        print_r($controller->index());

    }

}