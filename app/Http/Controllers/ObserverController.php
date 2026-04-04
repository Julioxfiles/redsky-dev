<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Subjects\UserSubject;
use App\Services\UserServiceB;
use App\Observers\EmailObserver;
use App\Observers\LogObserver;
use App\Observers\NotificationObserver;

// UserController
class ObserverController {

    public function save(Request $request) {
        
        $subject = new UserSubject(); // Asunto de usuario

        $subject->attach(new EmailObserver());
        $subject->attach(new LogObserver());
        $subject->attach(new NotificationObserver());

        $userService = new UserServiceB($subject);

        $result = $userService->register([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        
    }
}

