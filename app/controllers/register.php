<?php

// Bao gồm kết nối cơ sở dữ liệu và RegisterModel
//require_once '../config/connect.php'; // Kết nối cơ sở dữ liệu
require_once '../models/register.php'; // Lớp xử lý đăng ký người dùng

// Kiểm tra xem form có được gửi đi bằng phương thức POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu người dùng từ form
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : ''; //trim(): Loại bỏ các khoảng trắng dư thừa từ đầu và cuối chuỗi.
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role = 'viewer';  // Mặc định vai trò là 'viewer', có thể thay đổi nếu muốn

    // Kiểm tra nếu có trường nào bị bỏ trống
    if (empty($fullname) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    // Tạo đối tượng RegisterModel có thể gọi và sử dụng thuộc tính class bên model  và truyền kết nối vào
    $registerModel = new RegisterModel($conn);

    // Gọi phương thức registerUser để đăng ký người dùng(chuyển qua model kiểm tra đk thành công hay thất bại)
    $result = $registerModel->registerUser($fullname, $email, $password, $role);

    // Hiển thị kết quả đăng ký
    echo $result;
} else {
    // Nếu không phải POST thì thông báo lỗi
    echo "Invalid request method!";
}
?>
