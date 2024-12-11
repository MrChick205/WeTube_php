<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\xampp\htdocs\WeTube_php\app\models\login.php'; // Đường dẫn tới model
require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';

class LoginController
{
    protected $userModel;

    public function __construct($conn)
    {
        $this->userModel = new LoginModel($conn); // Khởi tạo đối tượng Login
    }

    public function login()
    {
        $error = null; // Khởi tạo biến lỗi

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            echo $email . $password;
            // Tìm người dùng theo email
            $user = $this->userModel->findByEmail($email); // Sửa biến
            print_r($user);
            if ($user && $this->userModel->checkPassword($user['password'], $password)) {
                // Đăng nhập thành công

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];

                // Chuyển hướng đến trang chính
                 header('Location: /WeTube_php/app/views/index.php');
                exit;
            } else {
                // Đăng nhập thất bại
                $error = "Email hoặc mật khẩu không đúng.";
            }
        }

        // Nếu có lỗi, có thể hiển thị thông báo lỗi trong view
        return $error; // Trả về lỗi để hiển thị nếu cần
    }

    public function logout()
    {
        session_destroy(); // Hủy session
        header("Location: login.php"); // Chuyển hướng tới trang đăng nhập
        exit();
    }
}
?>