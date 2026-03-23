<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

interface PaymentInterface {
    
    public function pay(float $amount): string ;

}

