<?php

namespace App\Services\Payments;

class PaymentService {
    
    protected PaymentInterface $payment;
    // You are able to recieve objects of the same interface. 
    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }
    
    public function process(float $amount) : string {
        /** PaymentService does not now how the payment is done.
         *  It delegate the payment to the injected object.
        */
        return $this->payment->pay($amount);       
    }

}