<?php
// app/Observers/EmailObserver.php
namespace App\Observers;

use App\Models\User;

class EmailObserver implements Observer
{
    public function update(User $user): void
    {
        echo "Sending mail...\n ";
    }
}