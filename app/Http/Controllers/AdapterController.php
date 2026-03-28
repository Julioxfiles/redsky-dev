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
use App\Patterns\Adapter\RealExample\PaymentController;
use App\Patterns\Adapter\RealExample\CashPayment;
use App\Patterns\Adapter\RealExample\PaypalPayment;
use App\Patterns\Adapter\RealExample\StripePayment;
use App\Patterns\Adapter\RealExample\PaypalAdapter;
use App\Patterns\Adapter\RealExample\StripeAdapter;

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

    public function realExample()
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
