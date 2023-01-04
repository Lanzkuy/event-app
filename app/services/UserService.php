<?php

namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Exceptions\InputValidationException;
use App\Models\User;
use App\Models\UserLoginRequest;
use App\Models\UserLoginResponse;
use App\Models\UserRegisterRequest;
use App\Models\UserRegisterResponse;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateUserLoginRequest(UserLoginRequest $request): void
    {
        if (empty(trim($request->email))) {
            throw new InputValidationException('Email must be filled');
        }

        if (empty(trim($request->password))) {
            throw new InputValidationException('Password must be filled');
        }

        $email_regex = "/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/";
        if (!preg_match($email_regex, $request->email)) {
            throw new InputValidationException('Email is not valid');
        }
    }

    public function validateUserRegisterRequest(UserRegisterRequest $request): void
    {
        if (empty(trim($request->email))) {
            throw new InputValidationException('Email must be filled');
        }

        if (empty(trim($request->name))) {
            throw new InputValidationException('Name must be filled');
        }

        if (empty(trim($request->password))) {
            throw new InputValidationException('Password must be filled');
        }

        if(strlen($request->name) < 4) {
            throw new InputValidationException('Name is too short, minimum is 4 characters');
        }

        if(strlen($request->name) > 50) {
            throw new InputValidationException('Name is too long, maximum is 50 characters');
        }

        if(strlen($request->password) < 8) {
            throw new InputValidationException('Password is too short, minimum is 8 characters');
        }

        if(strlen($request->password) > 50) {
            throw new InputValidationException('Password is too long, maximum is 50 characters');
        }

        if($request->confirm_password != $request->password) {
            throw new InputValidationException('Confirm password must be same as password');
        }

        $email_regex = "/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/";
        if (!preg_match($email_regex, $request->email)) {
            throw new InputValidationException('Email is not valid');
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

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

    public function register(UserRegisterRequest $request) : UserRegisterResponse
    {
        $this->validateUserRegisterRequest($request);

        $check_user = $this->userRepository->find('email', $request->email);

        if (!is_null($check_user)) {
            throw new AuthenticationException('User is already exist');
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->name = $request->name;

        $register = $this->userRepository->create($user);

        if(is_null($register)) {
            throw new AuthenticationException('Failed to register the user');
        }

        $response = new UserRegisterResponse;
        $response->user = $register;

        return $response;
    }
}
