<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

class StripePayment {

    public function payNow($total): string {
        return "Stripe says: {$total} payment done.";
    }

}