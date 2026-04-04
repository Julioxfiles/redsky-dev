<?php
// app/Observers/LogObserver.php
namespace App\Observers;

use App\Models\User;

class LogObserver implements Observer
{
    public function update(User $user): void
    {
        echo "Registering log...\n  ";
    }
}