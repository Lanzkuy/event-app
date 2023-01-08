<?php

namespace App\Models;

class EventStoreRequest
{
    public int $id;
    public int $category_id;
    public string $title;
    public string $description;
    public string $image_name;
    public string $image_tmp;
    public string $image_size;
    public string $image_current;
    public string $location;
    public string $start_datetime;
    public string $end_datetime;
}
