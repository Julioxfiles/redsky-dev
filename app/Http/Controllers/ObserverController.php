<?php

namespace App\Http\Controllers;

use App\Subjects\UserSubject;
use App\Services\UserServiceObserver;
use App\Observers\EmailObserver;
use App\Observers\LogObserver;
use App\Observers\NotificationObserver;

class ObserverController {

    public function index() {
        $subject = new UserSubject();

        $subject->attach(new EmailObserver());
        $subject->attach(new LogObserver());
        $subject->attach(new NotificationObserver());

        $userService = new UserServiceObserver($subject);

        $userService->register([
            'name' => 'Juan',
            'email' => 'juan@email.com'
        ]);
    }
}

