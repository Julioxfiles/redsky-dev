<?php

namespace App\Http;

use App\Http\Request;
use ReflectionClass;
use ReflectionMethod;

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
                return $this->runAction($route['action'], $request);
            }
        }

        throw new \Exception('Route not found: ' . $request->uri());
    }

    private function runAction(callable|array $action, Request $request)
    {
        // Closure
        if (is_callable($action)) {
            return $action($request);
        }

        // [Controller::class, 'method']
        if (is_array($action)) {
            [$controllerClass, $method] = $action;

            // Auto-instantiate controller with dependencies
            $controllerInstance = $this->resolve($controllerClass);

            // Inject Request if needed in method
            $reflection = new ReflectionMethod($controllerInstance, $method);
            $params = [];

            foreach ($reflection->getParameters() as $param) {
                $type = $param->getType();
                if ($type && $type->getName() === Request::class) {
                    $params[] = $request;
                }
            }

            return $controllerInstance->$method(...$params);
        }

        throw new \Exception('Invalid route action');
    }

    /**
     * Simple resolver: automatically injects constructor dependencies
     */
    private function resolve(string $class)
    {
        // Special handling for PDO
        if ($class === \PDO::class) {
            return \App\Database\Connection::make();
        }

        // Special handling for our Connection class (optional)
        if ($class === \App\Database\Connection::class) {
            return \App\Database\Connection::make();
        }

        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();

            if ($type) {
                $depClass = $type->getName();

                // Skip scalar types
                if (in_array($depClass, ['int', 'float', 'string', 'bool', 'array'])) {
                    // Use default value if available, or null
                    if ($param->isDefaultValueAvailable()) {
                        $dependencies[] = $param->getDefaultValue();
                    } else {
                        $dependencies[] = null;
                    }
                    continue;
                }

                // Recursively resolve class dependencies
                $dependencies[] = $this->resolve($depClass);
            } else {
                // No type-hint, use default value if available
                if ($param->isDefaultValueAvailable()) {
                    $dependencies[] = $param->getDefaultValue();
                } else {
                    $dependencies[] = null;
                }
            }
        }

        return $reflection->newInstanceArgs($dependencies);
    }

}