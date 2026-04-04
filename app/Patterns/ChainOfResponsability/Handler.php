<?php

namespace App\Patterns\ChainOfResponsability;

abstract class Handler
{
    protected ?Handler $next = null;

    public function setNext(Handler $handler): Handler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle(array $request)
    {
        if ($this->next) {
            return $this->next->handle($request);
        }

        return null;
    }
}