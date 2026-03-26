<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

abstract class NotifierDecorator implements NotifierInterface {
    protected NotifierInterface $wrappee;

    public function __construct(NotifierInterface $notifier) {
        // It wraps objects (does not modify them), 
        $this->wrappee = $notifier;
    }

    public function send(string $message): void {
        // Delegate the behavior to the original object        
        $this->wrappee->send($message);
    }
}