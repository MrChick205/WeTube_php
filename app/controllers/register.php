<?php

require_once('../models/register.php'); // Import file model

class RegisterController {
    public function register() {
        global $conn; // Lấy biến kết nối từ file connect.php
        $error = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $fullname = trim($_POST['fullname']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            
            if (empty($fullname) || empty($email) || empty($password)) {
                $error = "All fields are required!";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format!";
                }
            }

            if (empty($error)) {
                $registerModel = new RegisterModel($conn); // Truyền biến $conn vào model

                $result = $registerModel->registerUser($fullname, $email, $password);

                if ($result === true) {
                    echo "<script>
                            alert('Registered successfully!');
                            window.location.href = '../Views/login.php?rs=success';
                        </script>";
                    exit();
                } else {
                    $error = $result;
                }
            }
        }

        if (!empty($error)) {
            echo "<div class='error'>$error</div>";
        }
    }
}

$controller = new RegisterController();
$controller->register();

?>
