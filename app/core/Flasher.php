<?php

class Flasher
{
    public static function setFlash(string $message, string $type)
    {
        $_SESSION['alert'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['alert'])) {
            echo '<div class="alert alert-' . $_SESSION['alert']['type'] . ' alert-dismissible fade show" role="alert">
                    ' . $_SESSION['alert']['message'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['alert']);
        }
    }
}
