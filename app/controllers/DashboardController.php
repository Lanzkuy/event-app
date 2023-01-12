<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    private UserController $userController;
    private EventController $eventController;
    private TicketController $ticketController;
    private OrderController $orderController;

    public function __construct()
    {
        $this->userController = new UserController;
        $this->eventController = new EventController;
        $this->ticketController = new TicketController;
        $this->orderController = new OrderController;
    }

    public function index(string $param1 = 'index', string $param2 = 'index', string $param3 = '')
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];
            if ($role != "user") {
                header('Location: ' . BASE_URL . '/dashboard/admin');
                return;
            }
        }

        $data['title'] = 'Dashboard';
        $this->view('templates/header', $data);
        $this->view('dashboard/index');
        $this->view('templates/footer');
    }

    public function admin(string $param1 = 'index', string $param2 = 'index', string $param3 = '')
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];
            if ($role != "admin") {
                header('Location: ' . BASE_URL . '/dashboard');
                return;
            }
        }

        if ($param1 == 'index') {
            $data['title'] = 'Dashboard';
            $this->view('templates/header', $data);
            $this->view('dashboard/admin');
            $this->view('templates/footer');
        }

        if ($param1 . '/' . $param2 == 'user/change-password') {
            $this->userController->changePassword();
            return;
        }

        if ($param1 == 'user') {
            if($param2 == 'index') {
                $this->userController->index();
            }

            if($param2 == 'create') {
                $this->userController->create();
            }

            if($param2 == 'edit') {
                $this->userController->edit($param3);
            }

            if($param2 == 'update') {
                $this->userController->update($param3);
            }

            if($param2 == 'delete') {
                $this->userController->delete($param3);
            }

            return;
        }

        if ($param1 == 'event') {
            $this->eventController->index();
            return;
        }

        if ($param1 == 'ticket') {
            $this->ticketController->index();
            return;
        }

        if ($param1 == 'order') {
            $this->orderController->index();
            return;
        }
    }

    public function logout()
    {
        $_SESSION['user_session'] = null;
        header("Location: ./");
        return;
    }
}
