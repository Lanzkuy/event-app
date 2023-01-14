<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\OrderService;
use App\Models\OrderStoreRequest;
use App\Services\OrderDetailService;
use App\Services\TicketService;
use App\Models\OrderDetailStoreRequest;

class OrderController extends Controller
{
    private OrderService $orderService;
    private OrderDetailService $orderDetailService;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->orderService = $this->service('Order');
        $this->ticketService = $this->service('Ticket');
        $this->orderDetailService = $this->service('OrderDetail');
    }
    
    public function index()
    {
        $data['title'] = 'Order';
        $this->view('templates/header', $data);
        $this->view('admin/orders/index', $data);
        $this->view('templates/footer');
    }

    public function insert()
    {
        try {
            $orderStoreRequest = new OrderStoreRequest;
            $orderStoreRequest->ticket_amount = $_POST['ticket_amount'];
            $orderStoreRequest->ticket_price = $_POST['ticket_price'];
            $orderStoreRequest->ticket_stock = $_POST['ticket_stock'];

            $order1 = $this->orderService->checkIfUserAlreadyOrder();
            
            if(is_null($order1)){
                $this->orderService->storeOrder($orderStoreRequest);
            }else{
                $orderStoreRequest->id = $order1['id'];
                $this->orderService->updateOrder($orderStoreRequest);
            }

            $order2 = $this->orderService->checkIfUserAlreadyOrder();

            $orderDetailStoreRequest = new OrderDetailStoreRequest;
            $orderDetailStoreRequest->order_id = $order2['id'];
            $orderDetailStoreRequest->ticket_id = $_POST['ticket_id'];
            $orderDetailStoreRequest->ticket_amount = $_POST['ticket_amount'];
            $orderDetailStoreRequest->ticket_price = $_POST['ticket_price'];

            $orderDetails = $this->orderDetailService->getOrderDetailByOrderId($order2['id']);

            if($orderDetails){
                foreach($orderDetails as $orderDetail){
                    $orderDetailRow = $this->orderDetailService->checkIfSameTicket($_POST['ticket_id']);
                                        
                    if($orderDetailRow == 1){
                        $orderDetailStoreRequest = new OrderDetailStoreRequest();
                        $orderDetailStoreRequest->id = $orderDetail['id'];
                        $orderDetailStoreRequest->ticket_amount = $_POST['ticket_amount'];
                        $orderDetailStoreRequest->ticket_price = $_POST['ticket_price'];

                        $this->orderDetailService->updateOrderDetail($orderDetailStoreRequest);
                    }else{
                        $this->orderDetailService->storeOrderDetail($orderDetailStoreRequest);
                    }
                }
            }
            else{
                $this->orderDetailService->storeOrderDetail($orderDetailStoreRequest);
            }

            $this->ticketService->updateQtyTicket($_POST['ticket_id'], $_POST['ticket_amount']);

            header('Location: ' . BASE_URL . '/home/detail?id=' . $_POST["event_id"]);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getRowCount(): int
    {
        return $this->orderService->getRowCount();
    }

    public function getOrderSummary(): array
    {
        return $this->orderService->getOrderSummary();
    }
}
