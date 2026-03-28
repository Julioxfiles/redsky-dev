<?php

namespace App\Http;

use App\Http\Request;

class Router
{
    private array $routes = [];

    public function add(string $method, string $uri, callable|array $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function dispatch(Request $request)
    {
        foreach ($this->routes as $route) {
            if (
                $route['method'] === $request->method() &&
                $route['uri'] === $request->uri()
            ) {
                return $this->runAction($route['action']);
            }
        }

        http_response_code(404);
        return ['error' => 'Not Found'];
    }

    private function runAction(callable|array $action)
    {
        // Closure
        if (is_callable($action)) {
            return $action();
        }

        // [Controller::class, 'method']
        if (is_array($action)) {
            [$controller, $method] = $action;

            $instance = new $controller;

            return $instance->$method();
        }

        throw new \Exception('Invalid route action');
    }
}