<?php

namespace App\Core;

use App\Middleware\MustLoginMiddleware;
use App\Middleware\MustNotLoginMiddleware;

class Application
{
    protected $controller = 'login';
    protected $method = 'index';
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (is_null($url)) {
            $url = [$this->controller];
        }

        if (!file_exists($this->getControllerPath($url[0] . 'Controller'))) {
            require_once $this->getControllerPath('_404');
            return;
        }

        $this->controller = $url[0] . 'Controller';
        unset($url[0]);

        if ($this->controller != 'loginController' && $this->controller != 'registerController') {
            $mustLoginMiddleware = new MustLoginMiddleware;
            $mustLoginMiddleware->handle();
        } else {
            $mustNotLoginMiddleware = new MustNotLoginMiddleware;
            $mustNotLoginMiddleware->handle();
        }

        require_once $this->getControllerPath($this->controller);
        $this->controller = new ('App\\Controllers\\' . $this->controller);

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->parameters = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    private function getControllerPath(string $controller)
    {
        return '../app/Controllers/' . $controller . '.php';
    }
}
