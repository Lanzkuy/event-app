<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\UserEventService;
use App\Services\TicketService;
use App\Services\OrderService;
use App\Services\CategoryService;
use App\Services\OrderDetailService;

class UserHomeController extends Controller
{
    private UserEventService $userEventService;
    private TicketService $ticketService;
    private OrderService $orderService;
    private OrderDetailService $orderDetailService;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->userEventService = $this->service('UserEvent');
        $this->ticketService = $this->service('Ticket');
        $this->orderService = $this->service('Order');
        $this->categoryService = $this->service('Category');
        $this->orderDetailService = $this->service('OrderDetail');
    }

    public function index()
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];
            if ($role != "user") {
                header('Location: ' . BASE_URL . '/adminhome');
                exit();
            }
        }

        $limit = 5;
        $page = $_GET['page'] ?? null;
        $search = $_GET['search'] ?? null;

        if (empty($page)) {
            $position = 0;
            $page = 1;
        } else {
            $position = ($page - 1) * $limit;
        }

        if ($search) {
            $events = $this->userEventService->findAllEvent($search, $position, $limit);
        } else {
            $events = $this->userEventService->getAllEvent($position, $limit);
        }

        $row = $this->userEventService->paginateEvent($search);
        $numberOfPages = ceil($row / $limit);

        $order = $this->orderService->checkIfUserAlreadyOrder();
        $orderDetailCount = 0;

        if ($order) {
            $orderDetailCount = $this->orderDetailService->countOrderDetail($order['id']);
        }

        $orders_id = [];
        $orders = $this->orderService->getOrderByStatus(2);

        foreach ($orders as $order) {
            $orders_id[] = $order['id'];
        }

        $orderDetailCount2 = 0;

        foreach ($orders_id as $order_id) {
            $orderDetailCount2 += $this->orderDetailService->countOrderDetail($order_id);
        }

        $eventCount = $this->userEventService->getRowEvent();
        $categories = $this->categoryService->getAllCategory();

        $data['events'] = $events;
        $data['categories'] = $categories;
        $data['eventCount'] = $eventCount;
        $data['orderDetailCount'] = $orderDetailCount;
        $data['orderDetailCount2'] = $orderDetailCount2;
        $data['numberOfPages'] = $numberOfPages;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['title'] = 'Home';

        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }

    public function detail()
    {
        try {
            $id = $_GET['id'];

            $event = $this->userEventService->getEvent($id);
            $tickets = $this->ticketService->getTicketByEventId($event['id']);

            $data['event'] = $event;
            $data['tickets'] = $tickets;
            $data['title'] = "Detail Event";

            $this->view('templates/header', $data);
            $this->view('user/event/detail', $data);
            $this->view('templates/footer');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
