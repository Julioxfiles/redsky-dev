<?php
declare(strict_types=1);

namespace App\Services\Payments;

class PaypalAdapter implements PaymentInterface {

    private PaypalPayment $gateway;
    
    public function __construct(PaypalPayment $gateway) {
        $this->gateway = $gateway;
    }

    public function pay($amount): string {
        $this->gateway->makePayment($amount);
        return "The payment was done calling Paypal.";
    }

}