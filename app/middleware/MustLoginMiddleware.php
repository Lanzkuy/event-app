<?php

namespace App\Middleware;

class MustLoginMiddleware implements Middleware
{
    public function handle()
    {
        if (!isset($_SESSION['user_session'])) {
            echo "<script>
                    alert('You should sign in to access this page');
                 </script>";
            header('Location: ' . BASE_URL . '/');
            exit();
        }
    }
}
