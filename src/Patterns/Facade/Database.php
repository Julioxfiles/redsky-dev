<?php

namespace App\Patterns\Facade;

class Database {
    public function connect(): void {
        echo "Conectando a la base de datos...\n";
    }
}