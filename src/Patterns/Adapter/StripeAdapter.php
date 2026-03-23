<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

use App\Patterns\Adapter\PaymentInterface;
use App\Patterns\Adapter\StripePayment;

class StripeAdapter implements PaymentInterface {

    private StripePayment $gateway;
    
    public function __construct(StripePayment $gateway) {
        return $this->gateway = $gateway;
    }

    public function pay($amount): string {
        $this->gateway->payNow($amount);
        return "The payment was done calling Stripe.";
    }

    public function getName() : string {
        return "StripeAdapter";
    }
}