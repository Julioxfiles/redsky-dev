<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

class PaypalPayment {

    public function makePayment($sum): string {
        return "{$sum} Payment  done by the paypal.";
    }

}