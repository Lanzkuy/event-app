<?php

namespace App\Models;

class OrderStoreRequest
{
    public int $id;
    public int $ticket_amount;
    public int $ticket_price;
    public int $ticket_stock;
}
