<?php
// app/Services/UserService.php
namespace App\Services;

use App\Subjects\UserSubject;
use App\Models\User;

class UserServiceB
{
    protected UserSubject $subject;

    public function __construct(UserSubject $subject)
    {
        $this->subject = $subject;
    }

    public function register(array $data): User
    {
        // crear usuario
        $user = new User($data);

        // notificar a los observers
        $this->subject->notify($user);

        return $user;
    }
}
