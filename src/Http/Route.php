<?php

namespace App\Http;

class Route
{
    private static Router $router;

    public static function setRouter(Router $router): void
    {
        self::$router = $router;
    }

    public static function get(string $uri, $action): void
    {
        self::$router->add('GET', $uri, $action);
    }

    public static function post(string $uri, $action): void
    {
        self::$router->add('POST', $uri, $action);
    }
}