<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

abstract class NotifierDecorator implements NotifierInterface {

    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier) {
        $this->notifier = $notifier;
    }

    public function send(string $message) : string {
        return $this->notifier->send($message);
    }
}

