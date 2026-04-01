<?php
declare(strict_types=1);

namespace App\Services\Payments;

// This is a third party class. You can not modify it.
class PaypalPayment {

    public function makePayment($sum): string {
        return "Paypal says: {$sum} payment done.";
    }
   
}