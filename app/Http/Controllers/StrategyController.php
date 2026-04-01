<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\Payments\BitcoinAdapter;
use App\Services\Payments\BitcoinPayment;
use App\Services\Payments\PaymentService;
use App\Services\Payments\PaymentFactory;
use App\Services\Payments\PaypalPayment;
use App\Services\Payments\PaypalAdapter;
use App\Services\Payments\StripePayment;
use App\Services\Payments\StripeAdapter;
use App\Services\Payments\CreditCardPayment;
use App\Services\Payments\PaymentSimpleFactory;

// This class could be called PaymentController
class StrategyController {

    public function payAction(Request $request) {
        $method = $request->input('method');
        $strategy = PaymentFactory::make($method);
        /*
        if ($method === 'paypal') {
            $strategy = new PaypalAdapter(new PaypalPayment());            
        } elseif ($method === 'stripe') {
            $strategy = new StripeAdapter(new StripePayment());
        } elseif ($method === 'bitcoin') {
            $strategy = new BitcoinAdapter(new BitcoinPayment());            
        }
        */  
        // The Open/Close principle is being violeted.
        /** Open to extension, close to modification
         *  But if you do not have lots of different methods it's
         *  ok to viiolate it.
         */
        $service = new PaymentService($strategy);
        $result =  $service->process($request->input('amount'));
        echo $result;
    }
}

/**
 * English
 * Strategy focuses on changing an object's behavior
 * at runtime, allowing for interchangeable algorithms
 * (for example, different ways of calculating something) using a
 * common interface; In contrast, Simple Factory focuses on centralizing
 * object creation, deciding which class to instantiate based on
 * a condition, but without changing the behavior afterward.
 * In short: Strategy changes how something works, while
 * Simple Factory decides which object to create.
 *
 * Spanish
 * Strategy se enfoca en cambiar el comportamiento de un objeto
 * en tiempo de ejecución, permitiendo intercambiar algoritmos
 * (por ejemplo, diferentes formas de calcular algo) usando una
 * interfaz común; en cambio, Simple Factory se enfoca en centralizar
 * la creación de objetos, decidiendo qué clase instanciar según
 * una condición, pero sin cambiar el comportamiento después.
 * En resumen: Strategy cambia cómo algo funciona, mientras que
 * Simple Factory decide qué objeto crear.
 */