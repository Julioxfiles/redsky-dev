<?php

namespace App\Services\Payments;

class CreditCardPayment implements PaymentInterface {
    public function pay(float $amount): string {
        return "Pagando $amount con tarjeta\n";
    }
}