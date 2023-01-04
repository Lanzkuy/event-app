<?php

namespace App\Models;

class UserRegisterRequest
{
    public int $id;
    public string $email;
    public string $password;
    public string $confirm_password;
    public string $name;
}
