<?php
session_start(); // Đảm bảo rằng session đã được khởi động

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $userId = $_SESSION['user_id'];
    $userEmail = $_SESSION['user_email'];

    echo "User ID: " . htmlspecialchars($userId);
    echo "User Email: " . htmlspecialchars($userEmail);
} else {
    echo "Người dùng chưa đăng nhập.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href="auth/logout.php"><button>logout</button></a>
</body>
</html>