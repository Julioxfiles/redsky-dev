<?php

namespace App\Patterns\Facade;

class Logger {
    public function log(string $message): void {
        echo "Log: $message <br/>";
    }
}