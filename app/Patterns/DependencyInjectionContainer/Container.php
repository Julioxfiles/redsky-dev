<?php

namespace App\Patterns\DependencyInjectionContainer;
use ReflectionClass;

class Container
{
    public function make(string $class)
    {
        $reflection = new ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $class;
        }

        $parameters = $constructor->getParameters();

        $dependencies = [];

        foreach ($parameters as $param) {
            $type = $param->getType();

            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->make($type->getName());
            }
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}