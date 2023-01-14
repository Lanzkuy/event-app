<?php

namespace App\Services;

use App\Exceptions\ServiceManagementException;
use App\Models\OrderDetailStoreRequest;
use App\Models\OrderDetail;

use App\Repositories\OrderDetailRepository;

class OrderDetailService
{
    private OrderDetailRepository $orderDetailRepository;

    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function validateOrderDetailStoreRequest(OrderDetailStoreRequest $request)
    {

    }

    public function storeOrderDetail(OrderDetailStoreRequest $request)
    {
        $this->validateOrderDetailStoreRequest($request);

        $total_price = $request->ticket_amount * $request->ticket_price;
        
        $orderDetail = new OrderDetail;
        $orderDetail->order_id = $request->order_id;
        $orderDetail->ticket_id = $request->ticket_id;
        $orderDetail->qty = $request->ticket_amount;
        $orderDetail->total_price = $total_price;

        return $this->orderDetailRepository->store($orderDetail);
    }

    public function getOrderDetailById(int $id) : array
    {
        return $this->orderDetailRepository->getOrderDetailById($id);
    }

    public function getOrderDetailByOrderId(int $order_id)
    {   
        return $this->orderDetailRepository->getByOrderId($order_id);
    }

    public function getOneOrderDetailByOrderId(int $order_id)
    {   
        return $this->orderDetailRepository->getOneByOrderId($order_id);
    }

    public function countOrderDetail(int $order_id)
    {   
        return $this->orderDetailRepository->getCount($order_id);
    }

    public function deleteOrderDetail(int $id)
    {
        return $this->orderDetailRepository->delete($id);
    }

    public function updateOrderDetail(OrderDetailStoreRequest $request)
    {
        $total_price = $request->ticket_amount * $request->ticket_price;

        $orderDetail = new OrderDetail;
        $orderDetail->id = $request->id;
        $orderDetail->qty = $request->ticket_amount;
        $orderDetail->total_price = $total_price;

        return $this->orderDetailRepository->update($orderDetail);
    }

    public function checkIfSameTicket(int $ticket_id)
    {
        return $this->orderDetailRepository->checkTicket($ticket_id);
    }

    public function getOrderDetailSameTicket(int $ticket_id, int $order_id)
    {
        return $this->orderDetailRepository->getSameTicket($ticket_id, $order_id);
    }

}

