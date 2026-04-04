<?php

namespace App\Patterns\DependencyInjectionContainer;

class UserService
{
    protected UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getUsers()
    {
        return $this->repo->getAll();
    }
}