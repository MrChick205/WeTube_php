<?php
session_start(); // Đảm bảo rằng session đã được khởi động

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $userId = $_SESSION['user_id'];
    $userEmail = $_SESSION['user_email'];

    echo "User ID thanh cong: " . htmlspecialchars($userId);
    echo "User Email: " . htmlspecialchars($userEmail);
} else {
    echo "Người dùng chưa đăng nhập.";
}
?>