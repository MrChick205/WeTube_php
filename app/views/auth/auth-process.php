<?php
session_start();
require_once '../../controllers/user.php';


$userController = new UserController($conn);

// Xử lý yêu cầu từ người dùng
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'register':
            $userController->register();
            break;
        case 'login':
            $error = $userController->login();
            if ($error) {
                echo "<script>alert('$error'); window.location.href = '../Views/auth/login.php';</script>";
            } else {
                header("Location: ../Views/home.php"); // Chuyển hướng đến trang chính
                exit();
            }
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'update':
            $userController->updateUser();
            break;
        case 'getUser':
            $userId = $_POST['user_id'] ?? null;
            $userController->getUser($userId);
            break;
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
} else {
    echo "Không có yêu cầu nào được gửi!";
}

$conn->close(); // Đóng kết nối
?>