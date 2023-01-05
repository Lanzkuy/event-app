<?php

namespace App\Middleware;

class MustNotLoginMiddleware implements Middleware
{
    public function handle()
    {
        $roleValidationMiddleware = new RoleValidationMiddleware;
        $roleValidationMiddleware->handle();
    }
}
