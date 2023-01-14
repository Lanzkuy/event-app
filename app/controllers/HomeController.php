<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\EventService;
use App\Services\TicketService;
use App\Services\OrderService;
use App\Services\OrderDetailService;

class HomeController extends Controller
{
    private EventService $eventService;
    private TicketService $ticketService;
    private OrderService $orderService;

    public function __construct()
    {
        $this->eventService = $this->service('Event');
        $this->ticketService = $this->service('Ticket');
        $this->orderService = $this->service('Order');
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
    
        if(empty($page)){
            $position = 0; 
            $page = 1;
        }else{
            $position = ($page-1) * $limit;
        }

        if($search){
            $events = $this->eventService->findAllEvent($search, $position, $limit);
        }else{
            $events = $this->eventService->getAllEvent($position, $limit);
        }

        $row = $this->eventService->paginateEvent($search);
        $numberOfPages = ceil($row / $limit);

        $order = $this->orderService->checkIfUserAlreadyOrder();
        $orderDetailCount = 0;
        
        if($order)
        {
            $orderDetailCount = $this->orderDetailService->countOrderDetail($order['id']);
        }

        $orders_id = [];
        $orders = $this->orderService->getOrderByStatus(2);
 
        foreach($orders as $order){
             $orders_id[] = $order['id'];
        }
 
        $orderDetailCount2 = 0;
 
        foreach($orders_id as $order_id){
             $orderDetailCount2 += $this->orderDetailService->countOrderDetail($order_id);
        }

        $eventCount = $this->eventService->getRowEvent();
      
        $data['events'] = $events;
        $data['orderDetailCount'] = $orderDetailCount;
        $data['orderDetailCount2'] = $orderDetailCount2;
        $data['numberOfPages'] = $numberOfPages;
        $data['eventCount'] = $eventCount;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['title'] = 'Home';

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function detail()
    {
        try{
            $id = $_GET['id'];

            $event = $this->eventService->getEvent($id);
            $tickets = $this->ticketService->getTicketByEventId($event['id']);

            $data['event'] = $event;
            $data['tickets'] = $tickets;
            $data['title'] = "Detail Event";

            $this->view('templates/header', $data);
            $this->view('user/event/detail', $data);
            $this->view('templates/footer');

        }catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function logout() : void
    {
        $_SESSION['user_session'] = null;
        header("Location: ./");
        exit();
    }
}
