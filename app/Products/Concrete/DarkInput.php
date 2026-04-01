<?php

namespace App\Products\Concrete;

use App\Products\Input;

class DarkInput implements Input
{
    public function render(): string
    {
        //return "Dark Input";
        return "<input type='text' class='dark'>";
    }
}