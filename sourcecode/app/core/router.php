<?php

class Router
{
    protected $controller = 'home';
    protected $role = "user";
    protected $action = "index";
    protected $params = [];

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(trim($_GET['url'], '/')));
        }
    }

    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[0])) {
            if ($url[0] == "admin" || $url[0] == "authen" || $url[0] == "user" || $url[0] == "restaurant") {
                $this->role = $url[0];
                unset($url[0]);
            }

        }

        if (isset($url[1])) {
            if (file_exists("../app/controllers/$this->role/$url[1]Controller.php")) {
                $this->controller = $url[1];
                unset($url[1]);
            }

        }

        $this->controller = $this->controller . "Controller";
        require "../app/controllers/$this->role/$this->controller" . '.php';
        $this->controller = new $this->controller();

        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->action = $url[2];
                unset($url[2]);
            }

        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }
}