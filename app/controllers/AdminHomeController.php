<?php

namespace App\Controllers;

use App\Core\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];
            var_dump( $_SESSION['user_session']['role']);
            if ($role != "admin") {
                header('Location: ' . BASE_URL . '/home');
                exit();
            }
        }

        $data['title'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('home/admin');
        $this->view('templates/footer');
    }

    public function logout()
    {
        $_SESSION['user_session'] = null;
        header("Location: ./");
        exit();
    }
}
