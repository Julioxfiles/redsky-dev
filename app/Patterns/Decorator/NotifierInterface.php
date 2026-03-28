<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

interface NotifierInterface {
    // All notifications must use send()
    public function send(string $message): void;
}
