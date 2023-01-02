<?php
namespace App\Core;

class Application {
    protected $_controller = 'login';
    protected $_method = 'index';
    protected $_parameters = [];

    public function __construct() {
        $url = $this->parseURL();

        if(is_null($url)) {
            $url = [$this->_controller];
        }
        
        //Controller
        if(!file_exists($this->getControllerPath($url[0] . 'Controller'))) {
            require_once $this->getControllerPath('_404');
            return;
        }

        $this->_controller = $url[0] . 'Controller';
        unset($url[0]);

        require_once $this->getControllerPath($this->_controller);
        $this->_controller = new $this->_controller;

        //Method
        if(isset($url[1])) {
            if(method_exists($this->_controller, $url[1])) {
                $this->_method = $url[1];
                unset($url[1]);
            }
        }

        //Parameter
        if(!empty($url)) {
            $this->_parameters = array_values($url);
        }

        call_user_func_array([$this->_controller, $this->_method], $this->_parameters);
    }

    private function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');    
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    private function getControllerPath($controller) {
        return '../app/Controllers/' . $controller . '.php';
    }
}