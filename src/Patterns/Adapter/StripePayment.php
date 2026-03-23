<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

// This is a third party class. You can not modify it.
class StripePayment {

    public function payNow($total): string {
        return "Stripe says: {$total} payment done.";
    }

}