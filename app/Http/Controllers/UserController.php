<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Request;

class UserController extends Controller
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

    public function store(Request $request): array
    {
        return $this->userService->createUser($request->all());
    }
}

