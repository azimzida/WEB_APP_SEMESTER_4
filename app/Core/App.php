<?php

namespace App\Core;

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0]) && file_exists(__DIR__ . '/../Controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->controller = 'App\\Controllers\\' . ucwords($url[0]) . 'Controller';
            unset($url[0]);
        } else {
            $this->controller = 'App\\Controllers\\HomeController';
        }

        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
        } else {
            $this->controller = new \App\Controllers\HomeController();
            $this->method = 'notFound';
        }

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } else {
            $this->method = 'index';
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }
}
