<?php

namespace App\Patterns\Proxy;

interface DatabaseInterface {
    public function query(string $sql): void;
}