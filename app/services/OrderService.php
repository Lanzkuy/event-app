<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;

use App\Models\OrderStoreRequest;
use App\Repositories\OrderRepository;
use App\Models\OrderDetailStoreRequest;
use App\Exceptions\InputValidationException;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function validateOrderStoreRequest(OrderStoreRequest $request): void
    {
        if (empty(trim($request->ticket_amount))) {
            throw new InputValidationException('Ticket amount must be filled');
        }

        if ($request->ticket_amount <= 0) {
            throw new InputValidationException('Minimun tiket amount is 1');
        }

        if ($request->ticket_amount > $request->ticket_stock) {
            throw new InputValidationException('Maximum tiket amount is ' . $request->ticket_stock);
        }
    }

    public function storeOrder(OrderStoreRequest $request)
    {
        $this->validateOrderStoreRequest($request);

        $total_price = $request->ticket_amount * $request->ticket_price;

        $order = new Order;
        $order->total_qty = $request->ticket_amount;
        $order->total_price = $total_price;

        return $this->orderRepository->store($order);
    }

    public function updateDataOrder(OrderDetailStoreRequest $request)
    {
        $orderDetail = new OrderDetail;
        $orderDetail->order_id = $request->order_id;
        $orderDetail->qty = $request->qty;
        $orderDetail->total_price = $request->total_price;

        return $this->orderRepository->updateData($orderDetail);
    }

    public function updateOrder(OrderStoreRequest $request)
    {
        $this->validateOrderStoreRequest($request);

        $total_price = $request->ticket_amount * $request->ticket_price;

        $order = new Order;
        $order->id = $request->id;
        $order->total_qty = $request->ticket_amount;
        $order->total_price = $total_price;

        return $this->orderRepository->update($order);
    }

    public function deleteOrder(int $id)
    {
        return $this->orderRepository->delete($id);
    }

    public function checkIfUserAlreadyOrder()
    {
        return $this->orderRepository->check();
    }

    public function updateStatusOrder(int $id)
    {
        return $this->orderRepository->updateStatus($id);
    }

    public function getOrderByStatus(int $status)
    {
        return $this->orderRepository->getByStatus($status);
    }

    public function getOrderByOrderDetail(int $order_id)
    {
        return $this->orderRepository->getByOrderDetail($order_id);
    }

    public function getRowCount(): int
    {
        return $this->orderRepository->getRowCount();
    }

    public function getOrderSummary() : array
    {
        return $this->orderRepository->getOrderSummary();
    }
}
