<?php
require_once "C:xampp\htdocs\WeTube_php\app\config\connect.php";

class Movie {
    private $conn;
    private $table_name = "movies";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy thông tin phim theo movie_id
    public function getMovieById($movie_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Lấy tất cả phim
    public function getAllMovies() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Thêm mới một bộ phim
    public function createMovie($title, $description, $movie_url, $type_id, $poster) {
        $query = "INSERT INTO " . $this->table_name . " (title, description, movie_url, type_id, poster)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssds", $title, $description, $movie_url, $type_id, $poster);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Cập nhật thông tin phim
    public function updateMovie($movie_id, $title, $description, $movie_url, $type_id, $poster) {
        $query = "UPDATE " . $this->table_name . "
                  SET title = ?, description = ?, movie_url = ?, type_id = ?, poster = ?
                  WHERE movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssisi", $title, $description, $movie_url, $type_id, $poster, $movie_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Xóa một bộ phim
    public function deleteMovie($movie_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $movie_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Lấy tất cả phim theo type_id
    public function getMoviesByTypeId($type_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE type_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $type_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy 3 bộ phim mới nhất
    public function getLatestMovies($limit = 3) {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>