<?php
declare(strict_types=1);

namespace App\Patterns\Adapter\RealExample;

// This is a third party class. You can not modify it.
class StripePayment {

    public function charge($total): string {
        return "Stripe says: {$total} payment done.";
    }
    

}