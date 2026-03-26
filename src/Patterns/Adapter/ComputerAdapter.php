<?php

namespace App\Patterns\Adapter;

class ComputerAdapter implements ElectricalInterface  {

    private Computer $obj;

    public function __construct(Computer $obj)
    {
        $this->obj = $obj;
    }

    public function twoProngPlug()
    {
        return $this->obj->threeProngPlug();
    }

}