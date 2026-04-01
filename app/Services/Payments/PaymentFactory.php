<?php

namespace App\Services\Payments;

class PaymentFactory
{
    protected static array $strategies = [];

    public static function register(string $type, callable $resolver): void
    {
        self::$strategies[$type] = $resolver;
    }

    public static function make(string $type): PaymentInterface
    {
        if (!isset(self::$strategies[$type])) {
            throw new \Exception("Unsupported method");
        }

        return call_user_func(self::$strategies[$type]);
    }
}