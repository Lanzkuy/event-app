<?php

namespace App\Models;

class Order
{
    public int $id;
    public int $user_id;
    public string $order_date;
    public int $total_qty;
    public int $total_price;
    public string $created_at;
    public ?string $deleted_at;
}
