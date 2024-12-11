<?php
include '../config/connect.php'; // Kết nối tới cơ sở dữ liệu

class Login
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
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return $result ? mysqli_fetch_assoc($result) : null;
    }

    public function checkPassword($hashedPassword, $password)
    {
        return password_verify($password, $hashedPassword);
    }
}