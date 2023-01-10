<?php

namespace App\Models;

class TicketStoreRequest
{
    public int $id;
    public int $event_id;
    public float $price;
    public string $type;
    public string $description;
}