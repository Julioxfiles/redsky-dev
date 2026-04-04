<?php

namespace App\Http;

class Route
{
    private static Router $router;

    private array $route;

    public static function setRouter(Router $router): void
    {
        self::$router = $router;
    }

    public static function get(string $uri, $action): RouteItem
    {
        return self::$router->add('GET', $uri, $action);
    }

    public static function post(string $uri, $action): RouteItem
    {
        return self::$router->add('POST', $uri, $action);
    }

    public function middleware(array $middlewares): self
    {
        $this->route['middlewares'] = $middlewares;
        return $this;
    }
    
}