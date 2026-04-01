<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        //echo "Home Page";
        return view('home');
    }
}