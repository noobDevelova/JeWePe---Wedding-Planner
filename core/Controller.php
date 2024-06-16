<?php
class Controller
{
    public function __construct()
    {
        if ($this->requiresAuthentication() && !$this->isAuthenticated()) {
            $this->redirectToLogin();
        }
    }

    public function  isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    public function requiresAuthentication()
    {
        switch ($_GET['controller']) {
            case 'dashboard':
                return true;
            default:
                return false;
        }
    }

    public function redirectToLogin()
    {
        header('Location: index.php?controller=auth&action=login');
        exit();
    }

    // public function redirectToLanding()
    // {
    //     header('Location: index.php?controller=landing&action=index');
    //     exit();
    // }

    public function loadModel($model)
    {
        require_once 'models/' . $model . '.php';
        return new $model;
    }

    public function render($view, $data = [])
    {
        extract($data);
        require_once 'views/' . $view . '.php';
    }
}
