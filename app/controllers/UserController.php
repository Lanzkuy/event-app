<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'User';
        $this->view('templates/header', $data);
        $this->view('admin/users/index', $data);
        $this->view('templates/footer');
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $this->view('templates/header', $data);
        $this->view('admin/users/change-password', $data);
        $this->view('templates/footer');
    }
}