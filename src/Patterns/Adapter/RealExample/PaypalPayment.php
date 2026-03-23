<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

class PaypalPayment {

    public function makePayment($sum): string {
        return "Paypal says: {$sum} payment done.";
    }

}