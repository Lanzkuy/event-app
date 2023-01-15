<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Middleware\RoleValidationMiddleware;
use App\Models\UserLoginRequest;
use App\Services\UserService;
use Flasher;

class LoginController extends Controller
{
    private UserService $userService;
    private CaptchaController $captchaController;

    public function __construct()
    {
        $this->userService = $this->service('User');
        $this->captchaController = new CaptchaController();
    }

    public function index()
    {
        $captcha_code = $this->captchaController->generateCaptchaCode();
        $this->captchaController->setSession('captcha_code', $captcha_code);
        $image = $this->captchaController->createCaptchaImage($captcha_code);

        $data['title'] = 'Login';
        $data['captcha'] = $image;
        $this->view('templates/header', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }

    public function auth(): void
    {
        try {
            $captchaCode = $_POST['captcha'];

            if (empty($captchaCode)) {
                Flasher::setFlash('Captcha field must be filled', 'danger');
                echo "<script>location.href = '" . BASE_URL . "/';</script>";
                return;
            }

            if (!$this->captchaController->validateCaptcha($captchaCode)) {
                Flasher::setFlash('Captcha code was wrong', 'danger');
                echo "<script>location.href = '" . BASE_URL . "/';</script>";
                return;
            }

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
            Flasher::setFlash($ex->getMessage(), 'danger');
            echo "<script>location.href = '" . BASE_URL . "/';</script>";
            return;
        }
    }
}
