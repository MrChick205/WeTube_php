<?php

require_once '../config/connect.php';

class RegisterModel {
    private $db;

    public function __construct($connection) {
        $this->db = $connection; // $conn là đối tượng kết nối MySQLi
    }

    // Phương thức này kiểm tra xem email có tồn tại hay chưa trước khi cho phép đăng ký tài khoản mới
    public function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        
        // Sử dụng prepared statements của MySQLi
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);  // Gắn giá trị vào tham số
        
        $stmt->execute();
        $result = $stmt->get_result();//sử dụng mysqlnd
        return $result->num_rows > 0;
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
        $userCount = $result->fetch_row()[0];  // Lấy giá trị của cột đầu tiên (user_count)

        // Nếu chưa có người dùng nào, vai trò mặc định là admin
        if ($userCount == 0) {
            $role = 'admin';
        } else {
            // Nếu đã có người dùng, vai trò phải được chỉ định hoặc là 'viewer' mặc định
            $role = $role ?: 'viewer';
        }

        // Mã hóa mật khẩu trước khi lưu
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Chèn người dùng mới vào cơ sở dữ liệu
        $sql = "INSERT INTO users (user_name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Registration failed!";
        }
    }
}
?>
