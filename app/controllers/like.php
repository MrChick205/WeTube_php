<?php
session_start();
require_once('C:\xampp\htdocs\WeTube_php\app\models\like.php');

class LikeController {
    private $likeModel;

    public function __construct($conn) {
        $this->likeModel = new LikeModel($conn);
        
    }


    // Thêm hoặc xóa lượt yêu thích cho bộ phim
    public function toggleLike($user_id, $movie_id) {
        if ($this->likeModel->isLiked($user_id, $movie_id)) {
            $this->likeModel->removeLike($user_id, $movie_id);
        } else {
            $this->likeModel->addLike($user_id, $movie_id);
        }
    }

    // Lấy tổng số lượt yêu thích của bộ phim
    public function getLikeCount($movie_id) {
        return $this->likeModel->countLikes($movie_id);
    }


    // Kiểm tra trạng thái yêu thích của người dùng
    public function isLikedByUser($user_id, $movie_id) {
        return $this->likeModel->isLiked($user_id, $movie_id);
    }

    
}

$likeController = new LikeController($conn);


// Kiểm tra xem session và GET đã được thiết lập chưa
if (isset($_SESSION['user_id']) && isset($_GET['movie_id'])) {
    $user_id = $_SESSION['user_id']; 
    $movie_id = $_GET['movie_id']; 

    // Kiểm tra nếu yêu cầu là POST (người dùng nhấn nút yêu thích)
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['favorite'])) { 
            $likeController->toggleLike($user_id, $movie_id);
        }
    }

    // Lấy số lượng yêu thích của bộ phim
    $likeCount = $likeController->getLikeCount($movie_id);
    $isLiked = $likeController->isLikedByUser($user_id, $movie_id);
} else {
    $likeCount = 0; 
    $isLiked = false;
}
?>
