<?php
// app/Observers/NotificationObserver.php
namespace App\Observers;

use App\Models\User;

class NotificationObserver implements Observer
{
    public function update(User $user): void
    {
        echo "Sending a notification to the Administrator...\n ";
    }
}