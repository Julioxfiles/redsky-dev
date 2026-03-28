<?php

namespace App\Patterns\Decorator;

class EmailNotifier implements NotifierInterface {
    
    public function __construct() {
        // You coud use some code here if you want or not.
    }
    
    public function send(string $message): void {
        echo "EmailNotifier: Sending Email: $message <br>";
    }
    
}