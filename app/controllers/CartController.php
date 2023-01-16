<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\OrderService;
use App\Services\OrderDetailService;
use App\Models\OrderDetailStoreRequest;

class CartController extends Controller
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
        $order = $this->orderService->checkIfUserAlreadyOrder();

        if ($order) {
            $orderDetails = $this->orderDetailService->getOrderDetailByOrderId($order['id']);
        }

        $data['orderDetails'] = $orderDetails ?? null;
        $data['order'] = $order ?? null;
        $data['title'] = 'List Order';

        $this->view('templates/header', $data);
        $this->view('user/cart/index', $data);
        $this->view('templates/footer');
    }

    public function delete()
    {
        try {
            $orderDetail_id = $_POST['orderDetail_id'];
            $order_id = $_POST['order_id'];

            $orderDetail = $this->orderDetailService->getOneOrderDetailByOrderId($order_id);

            $orderDetailStoreRequest = new OrderDetailStoreRequest;
            $orderDetailStoreRequest->order_id = $order_id;
            $orderDetailStoreRequest->qty = $orderDetail['qty'];
            $orderDetailStoreRequest->total_price = $orderDetail['total_price'];

            $countOrderDetail = $this->orderDetailService->countOrderDetail($order_id);

            if ($countOrderDetail == 1) {
                $this->orderService->deleteOrder($order_id);
            } else {
                $this->orderService->updateDataOrder($orderDetailStoreRequest);
            }

            $this->orderDetailService->deleteOrderDetail($orderDetail_id);

            header('Location: ' . BASE_URL . '/cart');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function checkout()
    {
        try {
            $order_id = $_POST['order_id'];

            $this->orderService->updateStatusOrder($order_id);

            header('Location:' . BASE_URL . '/history');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
