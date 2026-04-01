<?php

namespace App\Services\Payments;

use Exception;

class PaymentSimpleFactory
{
    
    public static function make(string $type): PaymentInterface
    {
    
        return match($type) {
            'card'   => new CreditCardPayment(),
            'paypal' => new PaypalAdapter(new PayPalPayment()),
            'stripe' => new StripeAdapter(new StripePayment()),
            'bitcoin' => new BitcoinAdapter(new BitcoinPayment()),
            default  => throw new Exception("Method not found.")
        };
    

        /*
        if ($type == "card") {
            $strategy = new CreditCardPayment();
        } elseif ($type == "paypal") {
            $strategy = new PaypalAdapter(new PayPalPayment());
        } elseif ($type == "stripe") {
            $strategy = new StripeAdapter(new StripePayment());
        } elseif ($type == "bitcoin") {
            $strategy = new BitcoinAdapter(new BitcoinPayment());
        } 
        */   
    }
}
