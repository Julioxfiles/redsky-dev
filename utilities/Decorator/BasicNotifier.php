<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

class BasicNotifier implements NotifierInterface {

    public function send(string $message): string {
        return "Sending basic notification: {$message} ";
    }
    
}