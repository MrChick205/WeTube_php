<?php

class RegisterModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Phương thức này kiểm tra xem email có tồn tại hay chưa trước khi cho phép đăng ký tài khoản mới
    public function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    // Hàm để đăng ký người dùng mới
    public function registerUser($fullname, $email, $password, $role = null) {
        // Kiểm tra nếu email đã tồn tại
        if ($this->checkEmail($email)) {
            return "Email already exists!";
        }

        // Kiểm tra xem có người dùng nào trong bảng chưa
        $countQuery = "SELECT COUNT(*) FROM users";
        $result = $this->db->query($countQuery);
        $userCount = $result->fetchColumn();  // Lấy giá trị của cột đầu tiên (user_count)

        // Nếu chưa có người dùng nào, vai trò mặc định là admin
        if ($userCount == 0) {
            $role = 'admin';
        } else {
            // Nếu đã có người dùng, vai trò phải được chỉ định hoặc là 'user' mặc định
            $role = $role ?: 'user';
        }

        // Mã hóa mật khẩu trước khi lưu
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Chèn người dùng mới vào cơ sở dữ liệu
        $sql = "INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        if ($stmt->execute([$fullname, $email, $hashedPassword, $role])) {
            return "Registration successful!";
        } else {
            return "Registration failed!";
        }
    }
}
?>
