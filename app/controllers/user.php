<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\models\User.php';
class UserController {
    private $userModel;

    public function __construct($connection) {
        $this->userModel = new UserModel($connection);
    }

    public function getUserProfile($userId) {
        return $this->userModel->getUserById($userId);
    }

    public function updateUserProfile($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userName = $_POST['user_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $uploadDir = '../../public/uploads/';
            $user_img = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['image']['name']);
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $user_img = $filePath;
                } else {
                    echo "<p style='color: red;'>Failed to upload image.</p>";
                }
            }

            return $this->userModel->updateUser($userId, $userName, $email, $phone, $password, $user_img);
        }
        return false;
    }
}