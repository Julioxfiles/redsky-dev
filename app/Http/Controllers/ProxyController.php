<?php

namespace App\Http\Controllers;

use App\Patterns\Proxy\ProxyImage;
use App\Patterns\Proxy\DatabaseProxy;

class ProxyController {

    public function index(){
        title("ProxyImage");
        $image1 = new ProxyImage("foto1.jpg");
        $image2 = new ProxyImage("foto2.jpg");

        $image1->display().br(); // carga y muestra
        $image1->display().br(); // solo muestra (ya cargada)

        $image2->display().br(); // carga y muestra
    }

    public function index2() {
        title("DatabaseProxy");
        $adminDb = new DatabaseProxy('admin');
        $guestDb = new DatabaseProxy('guest');

        $adminDb->query("SELECT * FROM users").br(); // allowed
        $guestDb->query("SELECT * FROM users").br(); // denied
    }

}