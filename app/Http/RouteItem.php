<?php

namespace App\Http;

class RouteItem
{
    public string $method;
    public string $uri;
    public $action;
    public array $middlewares = [];

    public function middleware(array $middlewares): self
    {
        $this->middlewares = $middlewares;
        return $this;
    }
}