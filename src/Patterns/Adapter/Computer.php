<?php

namespace App\Patterns\Adapter;

// This represents a legacy code or a third party.
class Computer {

    public function threeProngPlug() {
        return "Computer is connected.";
    }

    public function turnComputerOn() {
        return "The computer is on";
    }

    public function turnComputerOff() {
        return "The computer is off";
    }

    public function loadingOS($os) {
        return "The computer is loaaing {$os}";
    }

}