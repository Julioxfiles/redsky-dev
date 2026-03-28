<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Support\Validator;
use App\Support\Mailer;
use Exception;

class UserService
{
    private UserRepository $userRepository;
    private Validator $validator;
    private Mailer $mailer;

    public function __construct(
        UserRepository $userRepository,
        Validator $validator,
        Mailer $mailer
    ) {
        $this->userRepository = $userRepository;
        $this->validator = $validator;
        $this->mailer = $mailer;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->all();
    }

    public function createUser(array $data): array
    {
        // Validación
        $this->validator->validate($data, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Regla de negocio
        if ($this->userRepository->emailExists($data['email'])) {
            throw new Exception("Email already exists");
        }

        // Crear usuario
        $user = $this->userRepository->create($data);

        // Acción secundaria
        $this->mailer->send(
            $user['email'],
            'Welcome',
            'Account created successfully'
        );

        return $user;
    }
}