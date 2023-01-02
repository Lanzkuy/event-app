<?php
spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once __DIR__ . '/Core/' . $class . '.php';
});

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once __DIR__ . '/Controllers/' . $class . '.php';
});