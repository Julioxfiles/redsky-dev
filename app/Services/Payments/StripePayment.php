<?php
declare(strict_types=1);

namespace App\Services\Payments;

// This is a third party class. You can not modify it.
class StripePayment {

    public function charge($total): string {
        return "Stripe says: {$total} payment done.";
    }
    

}