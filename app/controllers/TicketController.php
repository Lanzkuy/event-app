<?php

namespace App\Controllers;

use App\Core\Controller;

class TicketController extends Controller
{
    public function index()
    {
        $data['title'] = 'Ticket';
        $this->view('templates/header', $data);
        $this->view('admin/tickets/index', $data);
        $this->view('templates/footer');
    }
}