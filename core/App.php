<?php
class App
{
    protected $controller = 'LandingController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        session_start();

        $url = $this->parseUrl();

        if (isset($_SESSION['user_id'])) {
            $this->controller = 'DashboardController';
            $this->method = 'index';
        }

        if (isset($url[0])) {
            $controlName = ucfirst($url[0]) . 'Controller';
            if (file_exists(('controllers/' . $controlName . '.php'))) {
                $this->controller = $controlName;
                unset($url[0]);
            }
        }

        require_once 'controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        if (isset($_GET['controller']) && isset($_GET['action'])) {
            $url = [$_GET['controller'], $_GET['action']];
            // Jika ada parameter tambahan selain controller dan action
            foreach ($_GET as $key => $value) {
                if ($key !== 'controller' && $key !== 'action') {
                    $url[] = $value;
                }
            }
            return $url;
        }
        return [];
    }
}
