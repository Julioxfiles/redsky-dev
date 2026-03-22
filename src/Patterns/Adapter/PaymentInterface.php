<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

interface PaymentInterface {
    
    public function pay(float $amount): string ;

}

