<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Models\UserRegisterRequest;
use App\Services\UserService;
use Flasher;

class RegisterController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = $this->service('User');
    }

    public function index()
    {
        $data['title'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('register/index');
        $this->view('templates/footer');
    }

    public function auth(): void
    {
        try {
            $userRegisterRequest = new UserRegisterRequest;
            $userRegisterRequest->email = $_POST['email'];
            $userRegisterRequest->password = $_POST['password'];
            $userRegisterRequest->confirm_password = $_POST['confirm_password'];
            $userRegisterRequest->name = $_POST['name'];

            $this->userService->register($userRegisterRequest);

            Flasher::setFlash('Register success', 'success');
            header('Location: ' . BASE_URL . '/');
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
            $this->back();
        }
    }

    private function back(): void
    {
        echo "<script>location.href = '" . BASE_URL . "/register';</script>";
        return;
    }
}
