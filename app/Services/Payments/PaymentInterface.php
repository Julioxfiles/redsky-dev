<?php
declare(strict_types=1);

namespace App\Services\Payments;

interface PaymentInterface {
    
    public function pay(float $amount): string ;
    
}

