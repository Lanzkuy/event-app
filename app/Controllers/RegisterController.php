<?php
use app\Core\Controller;

class RegisterController extends Controller {
    public function index() {
        $data['title'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('register/index');
        $this->view('templates/footer');
    }
}