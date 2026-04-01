<?php

namespace App\Products\Concrete;

use App\Products\Input;

class LightInput implements Input
{
    public function render(): string
    {
        //return "Light Input";
        return "<input type='text' class='light'>";
    }
}