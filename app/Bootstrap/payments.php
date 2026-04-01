<?php

use App\Services\Payments\PaymentFactory;
use App\Services\Payments\StripeAdapter;
use App\Services\Payments\StripePayment;
use App\Services\Payments\PaypalAdapter;
use App\Services\Payments\PaypalPayment;
use App\Services\Payments\BitcoinPayment;
use App\Services\Payments\BitcoinAdapter;

PaymentFactory::register('stripe', function () {
    return new StripeAdapter(new StripePayment());
});

PaymentFactory::register('paypal', function () {
    return new PaypalAdapter(new PaypalPayment());
});

PaymentFactory::register('bitcoin', function () {
    return new BitcoinAdapter(new BitcoinPayment());
});
