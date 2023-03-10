<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\OrderService;
use App\Models\OrderStoreRequest;
use App\Services\OrderDetailService;
use App\Services\TicketService;
use App\Models\OrderDetailStoreRequest;
use App\Services\EventService;
use App\Services\UserService;
use Flasher;

class OrderController extends Controller
{
    private OrderService $orderService;
    private OrderDetailService $orderDetailService;
    private UserService $userService;
    private EventService $eventService;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->orderService = $this->service('Order');
        $this->ticketService = $this->service('Ticket');
        $this->eventService = $this->service('Event');
        $this->orderDetailService = $this->service('OrderDetail');
        $this->userService = $this->service('User');
    }

    public function index($order_id = '')
    {
        $data['orderData'] = $this->orderService->getOrders();
        $data['orderDataDetail'] = [];
        if ($order_id != '') {
            $data['orderDataDetail'] = $this->orderDetailService->getOrderDetailByOrderId($order_id);
        }
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

            if (is_null($order1)) {
                $this->orderService->storeOrder($orderStoreRequest);
            } else {
                $orderStoreRequest->id = $order1['id'];
                $this->orderService->updateOrder($orderStoreRequest);
            }

            $order2 = $this->orderService->checkIfUserAlreadyOrder();

            $orderDetailStoreRequest1 = new OrderDetailStoreRequest;
            $orderDetailStoreRequest1->order_id = $order2['id'];
            $orderDetailStoreRequest1->ticket_id = $_POST['ticket_id'];
            $orderDetailStoreRequest1->ticket_amount = $_POST['ticket_amount'];
            $orderDetailStoreRequest1->ticket_price = $_POST['ticket_price'];

            $orderDetails = $this->orderDetailService->getOrderDetailByOrderId($order2['id']);

            if (!$orderDetails) {
                $this->orderDetailService->storeOrderDetail($orderDetailStoreRequest1);
            } else {
                foreach ($orderDetails as $orderDetail) {
                    if ($orderDetail['ticket_id'] == $_POST['ticket_id']) {
                        $orderDetailStoreRequest2 = new OrderDetailStoreRequest();
                        $orderDetailStoreRequest2->id = $orderDetail['id'];
                        $orderDetailStoreRequest2->ticket_amount = $_POST['ticket_amount'];
                        $orderDetailStoreRequest2->ticket_price = $_POST['ticket_price'];

                        $this->orderDetailService->updateOrderDetail($orderDetailStoreRequest2);
                        break;
                    } else {
                        $this->orderDetailService->storeOrderDetail($orderDetailStoreRequest1);
                    }
                }
            }

            $this->ticketService->updateQtyTicket($_POST['ticket_id'], $_POST['ticket_amount']);

            header('Location: ' . BASE_URL . '/userhome/detail?id=' . $_POST["event_id"]);
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }
    }

    public function delete(int $id)
    {
        try {
            $status = $this->orderService->deleteOrder($id);

            if ($status) {
                Flasher::setFlash('Delete user success', 'success');
            } else {
                Flasher::setFlash('Delete user failed', 'danger');
            }
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }

        $this->back();
    }

    public function getOrderDetail(int $order_id)
    {
        $data['order_detail'] = $this->orderDetailService->getOrderDetailByOrderId($order_id);

        $this->view('admin/orders/index', $data);
    }

    public function getRowCount(): int
    {
        return $this->orderService->getRowCount();
    }

    public function getOrderSummary(): array
    {
        return $this->orderService->getOrderSummary();
    }

    private function back()
    {
        echo "<script>location.href = '" . BASE_URL . "/dashboard/admin/order';</script>";

        return;
    }
}
