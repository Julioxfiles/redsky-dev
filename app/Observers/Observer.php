<?php

namespace App\Observers;

use App\Models\User;

interface Observer
{
    public function update(User $user): void;
}