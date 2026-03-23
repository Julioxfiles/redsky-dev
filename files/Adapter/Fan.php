<?php

namespace App\Patterns\Adapter;

class Fan implements ElectricalInterface {

    public function twoProngPlug() {
        return "Fan is connected.";
    }
    
}