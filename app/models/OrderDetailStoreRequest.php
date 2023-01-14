<?php

namespace App\Models;

class OrderDetailStoreRequest
{
    public int $id;
    public int $order_id;
    public int $ticket_id;
    public int $qty;
    public int $total_price;
    public int $ticket_amount;
    public int $ticket_price;
}