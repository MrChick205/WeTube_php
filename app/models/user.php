<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_assoc($result);
        } else {
            echo "Error preparing statement: " . mysqli_error($this->conn);
            return null;
        }
    }

    // Cập nhật thông tin người dùng
    public function updateUser($userId, $userName, $email, $phone, $password, $image) {
        $sql = "UPDATE users SET user_name = ?, email = ?, phone = ?, password = ?, image = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            mysqli_stmt_bind_param($stmt, "sssssi", $userName, $email, $phone, $hashedPassword, $image, $userId);
            if (mysqli_stmt_execute($stmt)) {
                return true; // Cập nhật thành công
            } else {
                echo "Error executing statement: " . mysqli_error($this->conn);
                return false; // Cập nhật thất bại
            }
        } else {
            echo "Error preparing statement: " . mysqli_error($this->conn);
            return false;
        }
    }
}