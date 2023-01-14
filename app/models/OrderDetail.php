<?php

namespace App\Models;

class OrderDetail
{
    public int $id;
    public int $order_id;
    public int $ticket_id;
    public int $qty;
    public int $total_price;
}