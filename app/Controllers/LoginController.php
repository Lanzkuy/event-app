<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Middleware\RoleValidationMiddleware;
use App\Models\UserLoginRequest;
use App\Services\UserService;

class LoginController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = $this->service('User');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('login/index');
        $this->view('templates/footer');
    }

    public function auth(): void
    {
        try {
            $userLoginRequest = new UserLoginRequest;
            $userLoginRequest->email = $_POST['email'];
            $userLoginRequest->password = $_POST['password'];

            $response = $this->userService->login($userLoginRequest);

            $session = array();
            $session['id'] = $response->id;
            $session['email'] = $response->email;
            $session['name'] = $response->name;
            $session['role'] = $response->role;
            $_SESSION['user_session'] = $session;

            $roleValidationMiddleware = new RoleValidationMiddleware;
            $roleValidationMiddleware->handle();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
