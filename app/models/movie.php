<?php
require_once '../config/connect.php';

class MovieModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Lấy phim theo ID
    public function getMovieById($movie_id) {
        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Thêm phim vào danh sách yêu thích
    public function addToFavorites($user_id, $movie_id) {
        $stmt = $this->conn->prepare("INSERT INTO 'like' (user_id, movie_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $movie_id);
        return $stmt->execute();
    }

    // Thêm phim vào bộ sưu tập
    public function addToCollection($user_id, $movie_id) {
        $stmt = $this->conn->prepare("INSERT INTO collections (user_id, movie_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $movie_id);
        return $stmt->execute();
    }

    // Thêm bình luận
    public function addComment($user_id, $movie_id, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO comment (user_id, movie_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $movie_id, $comment);
        return $stmt->execute();
    }

    // Lấy danh sách bình luận
    public function getComments($movie_id) {
        $stmt = $this->conn->prepare("SELECT c.content, u.user_name FROM comment c JOIN users u ON c.user_id = u.user_id WHERE c.movie_id = ?");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
