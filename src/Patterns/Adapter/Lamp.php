<?php

namespace App\Patterns\Adapter;
// This is a class you did in your system. Not a third party class.
class Lamp implements ElectricalInterface {

    public function twoProngPlug() {
        return "Lamp is connected.";
    }

    public function turnLampOn(){
        return "The lamp is now lightin.";
    }

    public function turnLampOff() {
        return "The lamp stopped working.";
    }

}