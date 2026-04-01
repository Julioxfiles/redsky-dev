<?php
declare(strict_types=1);

namespace App\Services\Payments;

class BitcoinAdapter implements PaymentInterface {

    private BitcoinPayment $gateway;
    
    public function __construct(BitcoinPayment $gateway) {
        $this->gateway = $gateway;
    }

    public function pay($amount): string {
        //return "The payment was done calling Stripe.";
        return $this->gateway->executePayment($amount);
    }
    
}