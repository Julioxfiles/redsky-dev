<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

// This is a class that you did.
class CashPayment implements PaymentInterface {

    public function pay($total): string {
        return "Cash says: {$total} payment done.";
    }

    public function getName(): string{
        return "CashPayment";
    }

}