<?php

namespace App\Models;

class Ticket
{
    public int $id;
    public string $event_id;
    public float $price;
    public string $type;
    public string $created_at;
    public ?string $deleted_at;
}
