<?php    
// PHP Area
require_once __DIR__ . '/../../vendor/autoload.php';

title("The Adapter Pattern");
use App\Patterns\Adapter\ElectricalInterface;
use App\Patterns\Adapter\Lamp;
use App\Patterns\Adapter\Fan;
use App\Patterns\Adapter\Computer;
use App\Patterns\Adapter\ComputerAdapter;

$lamp = new Lamp();
connect($lamp);

$fan = new Fan();
connect($fan);

$comp = new Computer();
$comp = new ComputerAdapter($comp);
$comp->twoProngPlug();
connect($comp);

function connect(ElectricalInterface $obj) {
    echo $obj->twoProngPlug().br();
}

title("The Adapter real example");
use App\Patterns\Adapter\RealExample\PaymentController;
use App\Patterns\Adapter\RealExample\CashPayment;
use App\Patterns\Adapter\RealExample\PaypalPayment;
use App\Patterns\Adapter\RealExample\StripePayment;
use App\Patterns\Adapter\RealExample\PaypalAdapter;
use App\Patterns\Adapter\RealExample\StripeAdapter;

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

title("Decorator");
use App\Patterns\Decorator\EmailNotifier;
use App\Patterns\Decorator\SMSDecorator;
use App\Patterns\Decorator\SlackDecorator;

/* We use composition instead of inheritance.
   The decorator needs the object to be decorated → composition.
*/
$notifier = new EmailNotifier(); // $coffe = new Coffe(); 
$notifier = new SlackDecorator($notifier); // new AddMilk($coffe);
$notifier = new SMSDecorator($notifier); // new AddSugar($coffe);
$notifier->send("Hi world");

title("Without Facade (Fachada)");
use App\Patterns\Facade\AuthService;
use App\Patterns\Facade\Database;
use App\Patterns\Facade\Logger;
use App\Patterns\Facade\LoginFacade;

$auth = new AuthService();
$db = new Database();
$logger = new Logger();
$db->connect();
$auth->authenticate("Julio","1234");
$logger->log("Usuario autenticado");

title("With Facade (Fachada)");
$facade = new LoginFacade();
$facade->login("admin", "1234");


/* RESUMEN:
 Hides internal complexity
 Reduces customer coupling with the system
 Exposes a simple entry point.
 

 Oculta la complejidad interna
 Reduce el acoplamiento del cliente con el sistema
 Expone un punto de entrada sencillo
 

*/


function br(int $times = 1) { 
    for ($i = 1; $i <= $times; $i++) {
        echo "<br/>";
    }
}

function title(string $title, string $hn = "h2") { echo "<{$hn}>$title</{$hn}>"; }

?>
