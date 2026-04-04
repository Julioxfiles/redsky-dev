<?php
// app/Subjects/UserSubject.php
namespace App\Subjects;

use App\Observers\Observer;
use App\Models\User; 

class UserSubject
{
    protected array $observers = []; // Will be stored here.

    public function attach(Observer $observer): void
    {
        // Evitar duplicados
        foreach ($this->observers as $obs) {
            if ($obs === $observer) {
                return;
            }
        }

        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
            }
        }

        // Reindexar el array (opcional pero recomendable)
        $this->observers = array_values($this->observers);
    }

    public function notify(User $user): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($user);
        }
    }
}