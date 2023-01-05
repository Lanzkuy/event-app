<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];
            if ($role != "user") {
                header('Location: ' . BASE_URL . '/adminhome');
                exit();
            }
        }

        $data['title'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }

    public function logout() : void
    {
        $_SESSION['user_session'] = null;
        header("Location: ./");
        exit();
    }
}
