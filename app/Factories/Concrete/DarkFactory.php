<?php

namespace App\Factories\Concrete;

use App\Factories\UIFactory;
use App\Products\Button;
use App\Products\Input;
use App\Products\Concrete\DarkButton;
use App\Products\Concrete\DarkInput;

class DarkFactory implements UIFactory
{
    public function createButton(): Button
    {
        return new DarkButton();
    }

    public function createInput(): Input
    {
        return new DarkInput();
    }
}