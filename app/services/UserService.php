<?php

namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Models\UserLoginRequest;
use App\Models\UserLoginResponse;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $user = $this->userRepository->find('email', $request->email);

        if (is_null($user)) {
            throw new AuthenticationException('Email or password was wrong');
        }

        if ($request->password != $user->password) {
            throw new AuthenticationException('Email or password was wrong');
        }

        $response = new UserLoginResponse;
        $response->id = $user->id;
        $response->email = $user->email;
        $response->name = $user->name;
        $response->role = $user->role;

        return $response;
    }
}
