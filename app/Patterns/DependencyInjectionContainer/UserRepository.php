<?php

namespace App\Patterns\DependencyInjectionContainer;

class UserRepository
{
    public function getAll()
    {
        return ["User1", "User2"];
    }
}