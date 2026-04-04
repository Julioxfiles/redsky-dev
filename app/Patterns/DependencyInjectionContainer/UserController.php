<?php

namespace App\Patterns\DependencyInjectionContainer;

class UserController
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getUsers();
    }
}