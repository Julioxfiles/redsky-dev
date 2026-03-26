<?php

namespace App\Patterns\Facade;

class AuthService {
    public function authenticate(string $user, string $password): bool {
        echo "Autenticando usuario...\n";
        return true;
    }
}