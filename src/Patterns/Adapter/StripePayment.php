<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

class StripePayment {

    public function doThePayment($total): string {
        return "Stripe says: {$total} payment done.";
    }

}