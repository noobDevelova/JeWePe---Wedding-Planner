<?php
class AuthController extends Controller
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
    }

    public function login()
    {
        if ($this->isAuthenticated()) {
            header('Location: index.php?controller=dashboard&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user && $password === $user['password']) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php?controller=dashboard&action=index');
                exit();
            } else {
                $this->render('admin/auth/login', ['error' => 'Email atau password anda salah!']);
            }
        } else {
            $this->render('admin/auth/login');
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $this->redirectToLogin();
    }
}
