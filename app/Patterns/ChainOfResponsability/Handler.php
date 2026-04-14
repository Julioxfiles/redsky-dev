<?php

namespace App\Patterns\ChainOfResponsability;

use App\Http\Request;

abstract class Handler
{
    protected ?Handler $next = null;

    public function setNext(Handler $handler): Handler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle(Request $request)
    {
        if ($this->next) {
            return $this->next->handle($request);
        }

        return null;
    }
}