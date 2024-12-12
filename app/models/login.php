<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';

class LoginModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $query);

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

    public function checkPassword($hashedPassword, $password)
    {
        return password_verify($password, $hashedPassword);
    }
}
?>