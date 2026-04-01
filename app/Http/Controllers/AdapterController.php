<?php

namespace App\Http\Controllers;

// Teaching Example;
use App\Http\Controllers\Controller;
use App\Patterns\Adapter\ElectricalInterface;
use App\Patterns\Adapter\Lamp;
use App\Patterns\Adapter\Fan;
use App\Patterns\Adapter\Computer;
use App\Patterns\Adapter\ComputerAdapter;

// Real Example:
use App\Services\Payments\PaymentController;
use App\Services\Payments\CashPayment;
use App\Services\Payments\PaypalPayment;
use App\Services\Payments\StripePayment;
use App\Services\Payments\PaypalAdapter;
use App\Services\Payments\StripeAdapter;

class AdapterController extends Controller
{

    public function __construct()
    {
        //$this->userService = $userService;
    }

    public function index()
    {
        title("The Adapter Pattern");

        $lamp = new Lamp();
        $this->connect($lamp);

        $fan = new Fan();
        $this->connect($fan);

        $comp = new Computer();
        $comp = new ComputerAdapter($comp);
        $comp->twoProngPlug();
        $this->connect($comp);

    }

    public function index2()
    {
        title("The Adapter Pattern - Real example");

        // ChashPayment
        $cash = new CashPayment();
        $controller = new PaymentController($cash); // This would be called by a Router.
        echo "<pre>";
        print_r($controller->payAction(500));

        // StripeAdapter
        $stripeObj = new StripePayment();
        $adapter = new StripeAdapter($stripeObj);
        $controller = new PaymentController($adapter);
        print_r($controller->payAction(200));

        // PaypalAdapter
        $adapter= new PaypalAdapter(new PaypalPayment());
        $controller = new PaymentController($adapter);
        print_r($controller->payAction(150));
        echo "</pre>";

    }

    public function connect(ElectricalInterface $obj) {
         echo $obj->twoProngPlug().br();
    }

}
