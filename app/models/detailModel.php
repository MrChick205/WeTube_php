<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';
class DetailModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy thông tin phim theo ID
    public function getMovieById($movieId) {
        $sql = "SELECT * FROM movies WHERE movie_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $movieId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if  ($result && mysqli_num_rows($result) > 0)  {
                return mysqli_fetch_assoc($result);
            } else {
                echo "No movie found with the given ID.";
                return null;
            }
        } else {
            echo "Error preparing statement: " . mysqli_error($this->conn);
            return null;
        }
    }
}


