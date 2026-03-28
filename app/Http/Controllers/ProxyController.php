<?php

namespace App\Http\Controllers;
use App\Patterns\Proxy\ProxyImage;

class ProxyController {

    public function index(){
        title("Proxy");
        $image1 = new ProxyImage("foto1.jpg");
        $image2 = new ProxyImage("foto2.jpg");

        $image1->display().br(); // carga y muestra
        $image1->display().br(); // solo muestra (ya cargada)

        $image2->display().br(); // carga y muestra
    }

}