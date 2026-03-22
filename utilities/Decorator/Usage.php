<?php
declare(strict_types=1);
//Client Code (composition in action)

namespace App\Patterns\Decorator;

require_once __DIR__ . '/../../../vendor/autoload.php';

// Clase basica que implementa la interface NotifierInteface.
$notifier = new BasicNotifier(); 

/**
 * Wrap with Email. EmailNotifier usa el constructor de la clase padre NotifierDecorator.
 * Ya que no cuenta con un constructor, php ejecuta el constructor padre.
 * El constructor padre recibe un objeto de tipo NotifierInterface.
 */
$notifier = new EmailNotifier($notifier);

// Wrap again with SMS
$notifier = new SMSNotifier($notifier);
echo $notifier->send("Hello World");
