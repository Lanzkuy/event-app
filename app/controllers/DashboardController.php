<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    private UserController $userController;
    private UserHomeController $userHomeController;
    private EventController $eventController;
    private TicketController $ticketController;
    private OrderController $orderController;

    public function __construct()
    {
        $this->userController = new UserController;
        $this->userHomeController = new UserHomeController;
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

        if($param1 == "index"){
            $this->userHomeController->index();
        }
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

            if($param2 == 'store') {
                $this->userController->store();
            }

            if($param2 == 'edit') {
                $this->userController->edit($param3);
            }

            if($param2 == 'update') {
                $this->userController->update();
            }

            if($param2 == 'delete') {
                $this->userController->delete($param3);
            }

            return;
        }

        if ($param1 == 'event') {
            if($param2 == 'index') {
                $this->eventController->index();
            }

            if($param2 == 'store') {
                $this->eventController->store();
            }

            if($param2 == 'edit') {
                $this->eventController->edit($param3);
            }

            if($param2 == 'update') {
                $this->eventController->update();
            }

            if($param2 == 'delete') {
                $this->eventController->delete($param3);
            }

            return;
        }

        if ($param1 == 'ticket') {
            if($param2 == 'index') {
                $this->ticketController->index();
            }

            if($param2 == 'store') {
                $this->ticketController->store();
            }

            if($param2 == 'edit') {
                $this->ticketController->edit($param3);
            }

            if($param2 == 'update') {
                $this->ticketController->update();
            }

            if($param2 == 'delete') {
                $this->ticketController->delete($param3);
            }

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
