<?php
declare(strict_types=1);

namespace App\Patterns\Adapter;

use App\Patterns\Adapter\PaymentInterface;

class PaymentController
{
    private PaymentInterface $payment;

    // Controller receives a PaymentInterface, could be an adapter or a native gateway
    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function payAction(int $amount): void
    {
        if ($this->payment->pay($amount)) {
            echo json_encode([
                'success' => true,
                'message' => "A $ {$amount} payment was made successfully by {$this->payment->getName()}."
            ], JSON_PRETTY_PRINT);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Payment failed."
            ], JSON_PRETTY_PRINT);
        }
    }
}