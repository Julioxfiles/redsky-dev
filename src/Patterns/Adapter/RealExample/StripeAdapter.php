<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

class StripeAdapter implements PaymentInterface {

    private StripePayment $gateway;
    
    public function __construct(StripePayment $gateway) {
        $this->gateway = $gateway;
    }

    public function pay($amount): string {
        //return "The payment was done calling Stripe.";
        return $this->gateway->charge($amount);
    }
    
}