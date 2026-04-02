<?php
// app/Models/User.php

namespace App\Models;

class User
{
    public string $name;
    public string $email;

    public function __construct(array $data)
    {
        $this->name  = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
    }
}