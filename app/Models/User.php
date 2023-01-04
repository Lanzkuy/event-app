<?php

namespace App\Models;

class User
{
    public int $id;
    public string $email;
    public string $password;
    public string $name;
    public string $role;
    public string $created_at;
    public ?string $deleted_at;
}
