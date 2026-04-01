<?php

namespace App\Services\Payments;

class PaymentSimpleFactoryNoStaticMethod
{
    //public function __construct(PaymentInteface Logger $logger) {}

    public function create(string $type)
    {
        if ($type == "card") {
            $strategy = new CreditCardPayment();
        } elseif ($type == "paypal") {
            $strategy = new PaypalAdapter(new PayPalPayment());
        } elseif ($type == "stripe") {
            $strategy = new StripeAdapter(new StripePayment());
        } elseif ($type == "bitcoin") {
            $strategy = new BitcoinAdapter(new BitcoinPayment());
        } 
    }
}

$factory = new PaymentSimpleFactoryNoStaticMethod();
$payment = $factory->create('paypal');

// More flexible use:
/* Un método estático SÍ puede usar dependencias… 
   pero NO permite inyección de dependencias real (DI). 
   Un Simple Factory normalmente NO tiene estado porque 
   su única responsabilidad es: crear objetos, no recordarlos

   A static method CAN use dependencies…
   but it DOES NOT allow real dependency injection (DI).
   A Simple Factory typically has NO state because
   its only responsibility is to create objects, 
   not to remember them.
*/