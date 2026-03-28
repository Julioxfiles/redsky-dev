<?php

namespace App\Controllers;

use App\Http\Request;
use App\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): array
    {
        return $this->userService->getAllUsers();
    }

    public function store(): array
    {
        $request = Request::capture();

        return $this->userService->createUser($request->all());
    }
}

