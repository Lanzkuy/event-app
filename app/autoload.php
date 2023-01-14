<?php

require_once '../config/config.php';
require_once '../config/constants.php';

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);

    $core_path = __DIR__ . '/core/' . $class . '.php';
    $exceptions_path = __DIR__ . '/exceptions/' . $class . '.php';
    $middleware_path = __DIR__ . '/middleware/' . $class . '.php';
    $models_path = __DIR__ . '/models/' . $class . '.php';
    $repository_path = __DIR__ . '/repositories/' . $class . '.php';
    $service_path = __DIR__ . '/services/' . $class . '.php';
    $controller_path = __DIR__ . '/controllers/' . $class . '.php';

    if (file_exists($core_path)) {
        require_once $core_path;
    }

    if (file_exists($exceptions_path)) {
        require_once $exceptions_path;
    }

    if (file_exists($middleware_path)) {
        require_once $middleware_path;
    }

    if (file_exists($models_path)) {
        require_once $models_path;
    }

    if (file_exists($repository_path)) {
        require_once $repository_path;
    }

    if (file_exists($service_path)) {
        require_once $service_path;
    }

    if (file_exists($controller_path)) {
        require_once $controller_path;
    }
});
