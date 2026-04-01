<?php

namespace App\Patterns\Proxy;

class RealDatabase implements DatabaseInterface {
    public function query(string $sql): void {
        echo "Executing query: $sql\n";
    }
}