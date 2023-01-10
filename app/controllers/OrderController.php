<?php

namespace App\Controllers;

use App\Core\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $data['title'] = 'Order';
        $this->view('templates/header', $data);
        $this->view('admin/orders/index', $data);
        $this->view('templates/footer');
    }
}