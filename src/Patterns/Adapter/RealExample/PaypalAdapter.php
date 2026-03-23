<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

use App\Patterns\Adapter\RealExample\PaymentInterface;
use App\Patterns\Adapter\RealExample\PaypalPayment;

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