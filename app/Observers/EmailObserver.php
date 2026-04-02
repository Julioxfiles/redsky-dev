<?php
// app/Observers/EmailObserver.php
namespace App\Observers;

use App\Models\User;

class EmailObserver implements Observer
{
    public function update(User $user): void
    {
        // enviar email de bienvenida
    }
}