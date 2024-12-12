<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\models\User.php';

class UserController {
    private $userModel;

    public function __construct($connection) {
        $this->userModel = new UserModel($connection);
    }

    // Lấy thông tin người dùng theo ID
    public function getUserProfile($userId) {
        return $this->userModel->getUserById($userId);
    }

    // Cập nhật thông tin người dùng từ POST request
    public function updateUserProfile($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $userName = $_POST['user_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
    
             // Xử lý upload hình ảnh
             $uploadDir = '../../public/uploads/';
             $imagePath = $user['image']; // Default to current image
     
             if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                 $fileName = basename($_FILES['image']['name']);
                 $targetFilePath = $uploadDir . $fileName;
     
                 if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                     $imagePath = $targetFilePath;
                 } else {
                     echo "<p style='color: red;'>Failed to upload image.</p>";
                 }
             }
     

             // Cập nhật thông tin người dùng
             return $this->userModel->updateUser($userId, $userName, $email, $phone, $password, $imagePath);
         }
         return false; // Không phải là POST request
     }
 }