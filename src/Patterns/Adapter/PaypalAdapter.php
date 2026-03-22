<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

use App\Patterns\Adapter\PaymentInterface;
use App\Patterns\Adapter\PaypalPayment;

class PaypalAdapter implements PaymentInterface {

    private PaypalPayment $gateway;
    
    public function __construct(PaypalPayment $gateway) {
        return $this->gateway = $gateway;
    }

    public function pay($amount): string {
        $this->gateway->makePayment($amount);
        return "The payment was done calling Paypal.";
    }

}