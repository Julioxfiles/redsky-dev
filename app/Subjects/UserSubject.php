<?php
// app/Subjects/UserSubject.php
namespace App\Subjects;

use App\Observers\Observer;
use App\Models\User; 

class UserSubject
{
    protected array $observers = [];

    public function attach(Observer $observer): void
    {
        // add observer
    }

    public function detach(Observer $observer): void
    {
        // remove observer
    }

    public function notify(User $user): void
    {
        // loop observers and call update()
    }
}