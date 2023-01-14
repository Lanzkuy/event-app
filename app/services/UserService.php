<?php

namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Exceptions\InputValidationException;
use App\Exceptions\ServiceManagementException;
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

        $email_regex = "/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/";
        if (!preg_match($email_regex, $request->email)) {
            throw new InputValidationException('Email is not valid');
        }

        if (empty(trim($request->name))) {
            throw new InputValidationException('Name must be filled');
        }

        if (strlen($request->name) < 4) {
            throw new InputValidationException('Name is too short, minimum is 4 characters');
        }

        if (strlen($request->name) > 50) {
            throw new InputValidationException('Name is too long, maximum is 50 characters');
        }

        if (empty(trim($request->password))) {
            throw new InputValidationException('Password must be filled');
        }

        if (strlen($request->password) < 8) {
            throw new InputValidationException('Password is too short, minimum is 8 characters');
        }

        if (strlen($request->password) > 50) {
            throw new InputValidationException('Password is too long, maximum is 50 characters');
        }

        if ($request->confirm_password != $request->password) {
            throw new InputValidationException('Confirm password must be same as password');
        }
    }

    public function validateUserUpdateRequest(UserRegisterRequest $request) : void
    {
        if (empty(trim($request->email))) {
            throw new InputValidationException('Email must be filled');
        }

        $email_regex = "/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/";
        if (!preg_match($email_regex, $request->email)) {
            throw new InputValidationException('Email is not valid');
        }

        if (empty(trim($request->name))) {
            throw new InputValidationException('Name must be filled');
        }

        if (strlen($request->name) < 4) {
            throw new InputValidationException('Name is too short, minimum is 4 characters');
        }

        if (strlen($request->name) > 50) {
            throw new InputValidationException('Name is too long, maximum is 50 characters');
        }
    }

    public function validateChangePasswordRequest(string $old_password, string $new_password, string $confirm_password) : void
    {
        if (empty(trim($old_password))) {
            throw new InputValidationException('Old password must be filled');
        }

        if (empty(trim($new_password))) {
            throw new InputValidationException('New password must be filled');
        }

        if (empty(trim($confirm_password))) {
            throw new InputValidationException('Confirm password must be filled');
        }

        if ($new_password == $old_password) {
            throw new InputValidationException('New password cannot be same with old password');
        }

        if (strlen($new_password) < 8) {
            throw new InputValidationException('New password is too short, minimum is 8 characters');
        }

        if (strlen($new_password) > 50) {
            throw new InputValidationException('New password is too long, maximum is 50 characters');
        }

        if ($confirm_password != $new_password) {
            throw new InputValidationException('Confirm password must be same as password');
        }

        $user = $this->userRepository->get('id', $_SESSION['user_session']['id']);

        if($old_password != $user->password) {
            throw new InputValidationException('Old password is wrong');
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->get('email', $request->email);

        if (is_null($user)) {
            throw new AuthenticationException('Email or password was wrong');
        }

        if (password_verify($request->password, $user->password)) {

            $response = new UserLoginResponse;
            $response->id = $user->id;
            $response->email = $user->email;
            $response->name = $user->name;
            $response->role = $user->role;
    
            return $response;

        }else{
            throw new AuthenticationException('Email or password was wrong');
        }

      
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegisterRequest($request);

        $check_user = $this->userRepository->get('email', $request->email);

        if (!is_null($check_user)) {
            throw new AuthenticationException('User is already exist');
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_BCRYPT);
        $user->name = $request->name;

        $register = $this->userRepository->store($user);

        if (is_null($register) || $register == false) {
            throw new AuthenticationException('Failed to register the user');
        }

        $get_user = $this->userRepository->get('email', $request->email);

        $response = new UserRegisterResponse;
        $response->user = $get_user;

        return $response;
    }

    public function getUser(int $id): ?User
    {
        $event = $this->userRepository->get('id', $id);

        if (is_null($event)) {
            throw new ServiceManagementException('User not found');
        }

        return $event;
    }

    /*public function getUsers(int $position = 0, int $limit = 8): array
    {
        return $this->userRepository->getAll($position, $limit);
    }*/

    public function getUsers(): array
    {
        return $this->userRepository->getAll();
    }

    public function findUser(string $email, int $position = 0, int $limit = 8): array
    {
        return $this->userRepository->find($email, $position, $limit);
    }

    public function updateUser(UserRegisterRequest $request) : bool
    {
        $this->validateUserUpdateRequest($request);

        $user = new User;
        $user->id = $request->id;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = $request->role;

        $update = $this->userRepository->update($user);

        if (is_null($update)) {
            throw new ServiceManagementException('Failed to update user');
        }

        return $update;
    }

    public function deleteUser(int $id) : bool
    {
        $delete = $this->userRepository->delete($id);

        if (is_null($delete)) {
            throw new ServiceManagementException('Failed to delete user');
        }

        return $delete;
    }

    public function changePassword(string $old_password, string $new_password, string $confirm_password) : bool
    {
        $this->validateChangePasswordRequest($old_password, $new_password, $confirm_password);

        $change_password = $this->userRepository->changePassword($_SESSION['user_session']['id'], $confirm_password);

        if (is_null($change_password)) {
            throw new ServiceManagementException('Failed to change password');
        }

        return $change_password;
    }
}
