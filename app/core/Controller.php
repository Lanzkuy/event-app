<?php

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        require_once '../app/views/' . $view . '.php';
    }

    protected function service(string $name)
    {
        require_once '../app/services/' . $name . 'Service.php';
        $service_namespace = 'App\\Services\\';
        $repository_namespace = 'App\\Repositories\\';
        $service = "$service_namespace$name" . 'Service';
        $repository = "$repository_namespace$name" . 'Repository';
        return new $service(new $repository);
    }
}
