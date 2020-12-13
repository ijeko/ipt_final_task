<?php

class App
{
    protected $controller = 'Guest';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('../app/Controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once "../app/Controllers/" . $this->controller . '.php';
        $this->controller = new $this->controller;
        if (isset($url[0]) && $this->controller == new Guest()) {
            if (method_exists($this->controller, $url[0])) {
                $this->method = ucfirst($url[0]);
                unset($url[0]);
            }
        } elseif (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = ucfirst($url[1]);
                unset($url[1]);
            }
        }
        if ($url) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $request = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_STRING);
            $request = explode('/', $request);
            return $request;
        }
    }


}
