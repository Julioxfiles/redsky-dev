<?php

namespace App\Http;

use App\Http\Request;
use ReflectionClass;
use ReflectionMethod;

class Router
{
    private array $routes = [];

    /*
    public function add(string $method, string $uri, callable|array $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'action' => $action,
        ];
    }
    */

    public function add(string $method, string $uri, callable|array $action): RouteItem
    {
        $route = new RouteItem();
        $route->method = strtoupper($method);
        $route->uri = $uri;
        $route->action = $action;

        $this->routes[] = $route;

        return $route;
    }

    /*
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
    */
    
    public function dispatch(Request $request)
    {
        foreach ($this->routes as $route) {
            if (
                $route->method === $request->method() &&
                $route->uri === $request->uri()
            ) {
                return $this->runRoute($route, $request);
            }
        }

        throw new \Exception('Route not found: ' . $request->uri());
    }

    private function runRoute(RouteItem $route, Request $request)
    {
        $middlewares = $route->middlewares ?? [];

        // Final destination (controller)
        $core = function ($request) use ($route) {
            //return $this->runAction($route['action'], $request);
            return $this->runAction($route->action, $request);
        };

        // Build pipeline (reverse order)
        $pipeline = array_reduce(
            array_reverse($middlewares),
            function ($next, $middlewareKey) {
                return function ($request) use ($next, $middlewareKey) {
                    $class = \App\Http\Middleware\MiddlewareRegistry::get($middlewareKey);
                    $middleware = $this->resolve($class);

                    return $middleware->handle($request, $next);
                };
            },
            $core
        );

        return $pipeline($request);
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