<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\xampp\htdocs\WeTube_php\app\models\login.php';
require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';

class LoginController
{
    protected $userModel;

    public function __construct($conn)
    {
        $this->userModel = new LoginModel($conn);
    }

    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->findByEmail($email);
            if ($user && $this->userModel->checkPassword($user['password'], $password)) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];

                 header('Location: /WeTube_php/app/views/index.php');
                exit;
            } else {
                $error = "Email hoặc mật khẩu không đúng.";
            }
        }

        return $error;
    }

    public function logout()
    {
        session_destroy();
        header("Location: /WeTube_php/app/views/index.php");
        exit();
    }
}
?>