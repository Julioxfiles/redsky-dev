<?php

namespace App\Factories;

use App\Products\Button;
use App\Products\Input;

interface UIFactory
{
    public function createButton(): Button;
    public function createInput(): Input;
}