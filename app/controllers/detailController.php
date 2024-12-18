<?php
    require_once 'C:\xampp\htdocs\WeTube_php\app\models\detailModel.php';

    class DetailController {
        private $detailModel;
    
        public function __construct($connection) {
            $this->detailModel = new DetailModel($connection);
        }
    
        public function showMovieDetail($movieId) {
            $movie = $this->detailModel->getMovieById($movieId);
            if ($movie) {
                // Gửi dữ liệu đến view để hiển thị
                require 'views/detailDisplay.php';
            } else {
                // Hiển thị thông báo lỗi hoặc chuyển hướng
                echo "Movie not found!";
            }
    }
    }   

?>