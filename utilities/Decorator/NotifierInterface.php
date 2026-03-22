<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

interface NotifierInterface {

    public function send(string $message): string ;

}