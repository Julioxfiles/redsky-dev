<?php    
// PHP Area
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Patterns\Adapter\PaymentController;
use App\Patterns\Adapter\CashPayment;
//use App\Patterns\Adapter\PaypalPayment;
//use App\Patterns\Adapter\StripePayment;
//use App\Patterns\Adapter\PaypalAdapter;
//use App\Patterns\Adapter\StripeAdapter;
echo "<pre>";

// ChashPayment
$cash = new CashPayment();
$controller = new PaymentController($cash); // This would be called by a Router.
print_r($controller->payAction(500));

















// StripeAdapter
//$controller = new PaymentController(new StripePayment());
//print_r($controller->payAction(200));
br();

// PaypalAdapter
//$controller = new PaymentController(new PaypalPayment());
//print_r($controller->payAction(150));

function br() { echo "<br/>"; }

?>
