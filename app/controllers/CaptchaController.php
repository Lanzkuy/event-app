<?php

namespace App\Controllers;

class CaptchaController
{
    function generateCaptchaCode()
    {
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $alphabetLenght = strlen($alphabet) - 2;
        $captcha = array();

        for ($i = 0; $i < 5; $i++) {
            $rand = rand(0, $alphabetLenght);
            $captcha[] = $alphabet[$rand];
        }

        return implode($captcha);
    }

    function setSession($key, $value)
    {
        $_SESSION["$key"] = $value;
    }

    function getSession($key)
    {
        @session_start();
        $value = "";
        if (!empty($key) && !empty($_SESSION["$key"])) {
            $value = $_SESSION["$key"];
        }
        return $value;
    }

    function createCaptchaImage($captcha_code)
    {
        $layer = imagecreatetruecolor(100, 60);
        $background = imagecolorallocate($layer, 255, 255, 255);
        imagefill($layer, 0, 0, $background);
        $text_color = imagecolorallocate($layer, 0, 0, 0);
        imagestring($layer, 5, 25, 20, $captcha_code, $text_color);
        return $layer;
    }

    function renderCaptchaImage($imageData)
    {
        header("Content-type: image/jpeg");
        imagejpeg($imageData);
    }

    function validateCaptcha($formData)
    {
        $isValid = false;
        $capchaSessionData = $this->getSession("captcha_code");

        if ($capchaSessionData == $formData) {
            $isValid = true;
        }
        return $isValid;
    }
}
