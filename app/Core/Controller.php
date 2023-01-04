<?php

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []) : void
    {
        require_once '../app/views/' . $view . '.php';
    }
}
