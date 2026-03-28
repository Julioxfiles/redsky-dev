<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

class SlackDecorator extends NotifierDecorator {
    public function send(string $message): void {
        // Adds new functionality before or after it delegates.
        // Delegate the behavior to the original object        
        parent::send($message);
        echo "SlackDecoratorL Sending:$message to Slack. <br/>";
    }
}