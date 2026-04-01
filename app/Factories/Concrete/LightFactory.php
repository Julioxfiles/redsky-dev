<?php

namespace App\Factories\Concrete;

use App\Factories\UIFactory;
use App\Products\Button;
use App\Products\Input;
use App\Products\Concrete\LightButton;
use App\Products\Concrete\LightInput;

class LightFactory implements UIFactory
{
    public function createButton(): Button
    {
        return new LightButton();
    }

    public function createInput(): Input
    {
        return new LightInput();
    }
}