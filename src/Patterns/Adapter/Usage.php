<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Patterns\Adapter\OldPaymentGateway;
use App\Patterns\Adapter\PaymentAdapter;

$payment = new PaymentAdapter(new OldPaymentGateway());
$amount = 200;
if ($payment->pay($amount)) {
    echo "A $ {$amount} Payment was made. Thanks for your preference.";
};
