<?php
include_once __DIR__ . '/../models/movie.php';

class MoviesController {
    private $movie; // Đối tượng Movie
    // private $movie_id;

    // Constructor nhận vào đối tượng kết nối cơ sở dữ liệu
    public function __construct($conn) {
        // Khởi tạo đối tượng Movie với kết nối cơ sở dữ liệu
        $this->movie = new Movie($conn);
    }

    // Hàm để hiển thị thông tin chi tiết của một bộ phim
    public function getMovie($movie_id) {
        $movie_data = $this->movie->getMovieById($movie_id);
        if ($movie_data) {
            return $movie_data;
        } else {
            return "Không tìm thấy phim.";
        }
    }

    // Hàm để hiển thị tất cả các phim
    public function getAllMovies() {
        $movies = $this->movie->getAllMovies();
        if ($movies) {
            return $movies;
        } else {
            return "Không có phim nào.";
        }
    }

    // Hàm để thêm một bộ phim mới
    public function addMovie($title, $description, $movie_url, $type_id, $poster) {
        if ($this->movie->createMovie($title, $description, $movie_url, $type_id, $poster)) {
            return "Phim mới đã được thêm thành công!";
        } else {
            return "Thêm phim thất bại.";
        }
    }

    // Hàm để cập nhật thông tin phim
    public function updateMovie($movie_id, $title, $description, $movie_url, $type_id, $poster) {
        if ($this->movie->updateMovie($movie_id, $title, $description, $movie_url, $type_id, $poster)) {
            return "Cập nhật phim thành công!";
        } else {
            return "Cập nhật phim thất bại.";
        }
    }

    // Hàm để xóa một bộ phim
    public function deleteMovie($movie_id) {
        if ($this->movie->deleteMovie($movie_id)) {
            return "Xóa phim thành công!";
        } else {
            return "Xóa phim thất bại.";
        }

        if (isset($_POST['movie_id'])) {
            $movie_id = $_POST['movie_id'];
            if (is_numeric($movie_id)) {
                // Nếu movie_id hợp lệ, gọi phương thức deleteMovie
                // $deleteMovies = $moviectrll->deleteMovie($movie_id);
        
                // Trả kết quả về cho client (browser)
                echo $deleteMovies;
            } else {
                // Nếu movie_id không hợp lệ
                echo "Invalid movie ID.";
            }
        } else {
            // Nếu không có movie_id, in ra thông báo lỗi
            echo "Movie ID is not provided.";
        }
        
    }

    // Hàm để lấy tất cả phim theo type_id
    public function getMoviesByType($type_id) {
        $movies = $this->movie->getMoviesByTypeId($type_id);
        if ($movies) {
            return $movies;
        } else {
            return "Không tìm thấy phim nào cho loại này.";
        }
    }

    // Hàm để lấy 3 bộ phim mới nhất
    public function getLatestMovies() {
        $latest_movies = $this->movie->getLatestMovies();
        if ($latest_movies) {
            return $latest_movies;
        } else {
            return "Không có phim mới nào.";
        }
    }

    //Lấy bình luận phim
    public function getCommentsByMovie($movie_id) {
        $comments = $this->movie->getCommentsByMovieId($movie_id);
        if ($comments) {
            return $comments;
        } else {
            return [];
        }
    }

      // Hàm để xóa một bộ phim
      public function deleteComment($comment_id, $movie_id) {
        if ($this->movie->deleteComment($comment_id, $movie_id)) {
            return "Xóa bình luận thành công!";
        } else {
            return "Xóa bình luận thất bại.";
        }
    }
}

// Ví dụ sử dụng
$moviectrll = new MoviesController($conn);
$movieitems = $moviectrll->getAllMovies();
$latestMovies = $moviectrll->getLatestMovies(); 
?>