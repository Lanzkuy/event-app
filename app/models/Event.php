<?php

namespace App\Models;

class Event
{
    public int $id;
    public int $category_id;
    public int $user_id;
    public string $title;
    public string $description;
    public string $image;
    public string $location;
    public string $start_datetime;
    public string $end_datetime;
    public ?string $status;
    public string $created_at;
    public ?string $deleted_at;
}
