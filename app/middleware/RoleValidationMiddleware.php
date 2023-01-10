<?php

namespace App\Middleware;

class RoleValidationMiddleware implements Middleware
{
    public function handle()
    {
        if (isset($_SESSION['user_session'])) {
            $role = $_SESSION['user_session']['role'];

            if ($role == "admin") {
                header('Location: ' . BASE_URL . '/dashboard/admin');
                exit();
            } else {
                header('Location: ' . BASE_URL . '/dashboard');
                exit();
            }
        }
    }
}
