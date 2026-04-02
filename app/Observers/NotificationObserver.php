<?php
// app/Observers/NotificationObserver.php
namespace App\Observers;

use App\Models\User;

class NotificationObserver implements Observer
{
    public function update(User $user): void
    {
        // enviar notificación
    }
}