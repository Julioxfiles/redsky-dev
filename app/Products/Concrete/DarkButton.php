<?php

namespace App\Products\Concrete;

use App\Products\Button;

class DarkButton implements Button
{
    public function render(): string
    {
        //return "Dark Button";
        return "<button class='btn dark'>I am a dark button</button>";
    }
}