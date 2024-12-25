<?php

require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';

class UserModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection; // Đối tượng kết nối MySQLi
    }

    // Kiểm tra xem email có tồn tại hay chưa
    public function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Đăng ký người dùng mới
    public function registerUser($fullname, $email, $password, $role = null) {
        if ($this->checkEmail($email)) {
            return "Email already exists!";
        }

        // Kiểm tra số lượng người dùng hiện có
        $countQuery = "SELECT COUNT(*) FROM users";
        $result = $this->conn->query($countQuery);
        $userCount = $result->fetch_row()[0];

        // Xác định vai trò
        if ($userCount == 0) {
            $role = 'admin';
        } else {
            $role = $role ?: 'viewer';
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Chèn người dùng mới vào cơ sở dữ liệu
        $sql = "INSERT INTO users (user_name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            return true;  // Đăng ký thành công
        } else {
            return "Lỗi: " . $stmt->error;  // Thông báo lỗi
        }
    }

    // Lấy thông tin người dùng theo email
    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die('Prepare failed: ' . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user ? $user : null;
    }

    // Kiểm tra mật khẩu
    public function checkPassword($hashedPassword, $password) {
        return password_verify($password, $hashedPassword);
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về mảng thông tin người dùng hoặc null
    }

    // Cập nhật thông tin người dùng
    public function updateUser($userId, $userName, $email, $birth, $password, $image) {
        $sql = "UPDATE users SET user_name = ?, email = ?, birth = ?, password = ?, image = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            mysqli_stmt_bind_param($stmt, "sssssi", $userName, $email, $birth, $hashedPassword, $image, $userId);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                echo "Error executing statement: " . mysqli_error($this->conn);
                return false;
            }
        } else {
            echo "Error preparing statement: " . mysqli_error($this->conn);
            return false;
        }
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }
}

?>
