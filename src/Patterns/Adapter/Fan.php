<?php

namespace App\Patterns\Adapter;
// This is a class you did in your system. Not a third party class.
class Fan implements ElectricalInterface {

    public function twoProngPlug() {
        return "Fan is connected.";
    }

    public function firstSpeed() {
        return "Working in first speed now.";
    }

    public function secondSpeed() {
        return "Working in second speed now.";
    }

    public function thirdSpeed() {
        return "Working in third speed now.";
    }
    
}