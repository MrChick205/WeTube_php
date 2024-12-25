<?php

require_once 'C:\xampp\htdocs\WeTube_php\app\models\user.php'; // Bao gồm model UserModel
require_once 'C:\xampp\htdocs\WeTube_php\vendor\sendEmail.php'; // Bao gồm lớp SendEmail nếu cần

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn); // Khởi tạo UserModel với kết nối
    }

    // Đăng ký người dùng mới
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $error = ''; // Khởi tạo biến lỗi

            // Kiểm tra các trường dữ liệu
            if (empty($fullname) || empty($email) || empty($password)) {
                $error = "Vui lòng điền đầy đủ thông tin!";
            }

            if (empty($error)) {
                $result = $this->userModel->registerUser($fullname, $email, $password);

                if ($result === true) {
                    // Gửi email sau khi đăng ký thành công
                    $sendEmail = new SendEmail();
                    $sendEmail->sendEmail($email, $fullname, $password);

                    echo "<script>
                            alert('Đăng ký thành công!');
                            window.location.href = '../Views/auth/login.php?rs=success';
                        </script>";
                    exit();
                } else {
                    $error = $result; // Lưu thông báo lỗi
                }
            }

            // Nếu có lỗi, hiển thị thông báo lỗi
            if (!empty($error)) {
                echo "<script>
                        alert('$error');
                        window.location.href = '../Views/auth/register.php';
                    </script>";
            }
        }
    }

    // Đăng nhập người dùng
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);
            if ($user && $this->userModel->checkPassword($user['password'], $password)) {
                // Đăng nhập thành công
                $_SESSION['user_id'] = $user['user_id']; // Lưu ID người dùng vào session
                return null; // Đăng nhập thành công không trả về lỗi
            } else {
                return "Email hoặc mật khẩu không chính xác!"; // Trả về thông báo lỗi
            }
        }
        return null; // Trả về null nếu không có yêu cầu POST
    }

    // Đăng xuất người dùng
    public function logout() {
        session_start(); // Bắt đầu phiên nếu chưa bắt đầu
        session_unset(); // Xóa tất cả các biến phiên
        session_destroy(); // Hủy phiên

        header("Location: ../Views/auth/login.php?logout=success");
        exit();
    }

    // Cập nhật thông tin người dùng
    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $userName = $_POST['user_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $birth = $_POST['birth'] ?? '';
            $password = $_POST['password'] ?? '';
            $image = $_FILES['image'] ?? '';

            if ($this->userModel->updateUser($userId, $userName, $email, $birth, $password, $image)) {
                echo "<script>
                        alert('Cập nhật thông tin thành công!');
                        window.location.href = '../Views/user/profile.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Lỗi trong việc cập nhật thông tin!');
                        window.history.back();
                    </script>";
            }
        }
    }

    // Lấy thông tin người dùng
    public function getUser($userId) {
        $user = $this->userModel->getUserById($userId);
        if ($user) {
            return $user; // Trả về thông tin người dùng dưới dạng JSON
        } else {
            echo "Không tìm thấy người dùng!";
        }
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers() {
        $users = $this->userModel->getAllUsers();
        return $users; // Trả về danh sách người dùng dưới dạng JSON
    }
}

?>
