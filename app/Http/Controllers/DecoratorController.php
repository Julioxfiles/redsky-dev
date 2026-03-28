<?php

namespace App\Http\Controllers;

use App\Patterns\Decorator\EmailNotifier;
use App\Patterns\Decorator\SMSDecorator;
use App\Patterns\Decorator\SlackDecorator;

class DecoratorController {

    public function index() {
        title("Decorator");
        
        /* We use composition instead of inheritance.
        The decorator needs the object to be decorated → composition.
        */
        $notifier = new EmailNotifier(); // $coffe = new Coffe(); 
        $notifier = new SlackDecorator($notifier); // new AddMilk($coffe);
        $notifier = new SMSDecorator($notifier); // new AddSugar($coffe);
        $notifier->send("Hi world");

    }

}
