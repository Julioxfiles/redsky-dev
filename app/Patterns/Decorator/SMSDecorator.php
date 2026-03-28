<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

class SMSDecorator extends NotifierDecorator {
    public function send(string $message): void {
        // Adds new functionality before or after it delegates.
        // Delegate the behavior to the original object        
        parent::send($message);
        echo "SMSDecorator: Sending $message by SMS.<br>";
    }
}