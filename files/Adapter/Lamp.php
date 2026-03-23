<?php

namespace App\Patterns\Adapter;

class Lamp implements ElectricalInterface {

    public function twoProngPlug() {
        return "Lamp is connected.";
    }

}