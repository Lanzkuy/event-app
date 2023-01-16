<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\OrderService;
use App\Services\OrderDetailService;

class HistoryController extends Controller
{
    private OrderService $orderService;
    private OrderDetailService $orderDetailService;

    public function __construct()
    {
        $this->orderService = $this->service('Order');
        $this->orderDetailService = $this->service('OrderDetail');
    }

    public function index()
    {
        $ordersArray = [];
        $orders = $this->orderService->getOrderByStatus(2);

        $orderDetails = [];
        foreach ($orders as $order) {
            $orderDetails[] = $this->orderDetailService->getOrderDetailByOrderId($order['id']);
        }

        $data['title'] = 'List Ordered Tickets';
        $data['orderDetail'] = $orderDetails;

        $this->view('templates/header', $data);
        $this->view('user/history/index', $data);
        $this->view('templates/footer');
    }
}
