<?php

namespace App\Models;

class TicketStoreRequest
{
    public int $event_id;
    public int $price;
    public int $stock;
    public string $type;
    public string $description;
}