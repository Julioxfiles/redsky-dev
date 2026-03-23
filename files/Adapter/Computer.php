<?php

namespace App\Patterns\Adapter;

class Computer {

    public function threeProngPlug() {
        return "Computer is connected.";
    }

    public function turnComputerOn() {
        return "The computer is on";
    }

}