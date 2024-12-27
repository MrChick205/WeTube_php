<?php
require_once('C:\xamppp\htdocs\Wetube\WeTube_php\app\config\connect.php');

class LikeModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        
    }

    // Thêm yêu thích cho một bộ phim
    public function addLike($user_id, $movie_id) {
        $query = "INSERT INTO `like` (user_id, movie_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $movie_id);
        return $stmt->execute();
    }

    // Xóa lượt yêu thích cho một bộ phim
    public function removeLike($user_id, $movie_id) {
        $query = "DELETE FROM `like` WHERE user_id = ? AND movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $movie_id);
        return $stmt->execute();
    }
    // Kiểm tra xem user đã thích bộ phim này chưa
    public function isLiked($user_id, $movie_id) {
        $query = "SELECT * FROM `like` WHERE user_id = ? AND movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Đếm tổng số lượt thích của bộ phim
    public function countLikes($movie_id) {
        $query = "SELECT COUNT(*) as total_likes FROM `like` WHERE movie_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_likes'];
    }
}
?>
