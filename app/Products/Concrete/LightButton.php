<?php

namespace App\Products\Concrete;

use App\Products\Button;

class LightButton implements Button
{
    public function render(): string
    {
        //return "Light Button";
        return "<button class='btn light'>I am a light button</button>";
    }
}