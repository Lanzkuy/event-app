<?php
spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);

    $config_path = '../config/' . $class . '.php';
    $controller_path = __DIR__ . '/controller/' . $class . '.php';
    $core_path = __DIR__ . '/core/' . $class . '.php';

    if (file_exists($config_path)) {
        require_once $config_path;
    }

    if (file_exists($controller_path)) {
        require_once $controller_path;
    }

    if (file_exists($core_path)) {
        require_once $core_path;
    }
});
