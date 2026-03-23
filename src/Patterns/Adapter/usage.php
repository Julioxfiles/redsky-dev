<?php

// New gateway that already implements PaymentInterface
$controller = new PaymentController(new StripePayment());
$controller->payAction(200);

// Legacy gateway wrapped in adapter
$controller = new PaymentController(new PaypalPayment());
$controller->payAction(150);