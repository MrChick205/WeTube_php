<?php
include_once '../models/movie.php';

class MoviesController {
    private $movie; // Đối tượng Movie

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
}

// Ví dụ sử dụng
$moviectrll = new MoviesController($conn);
$movie = $moviectrll->getMovie(1);
$moviesByType = $moviectrll->getMoviesByType(2); // Lấy phim theo type_id
?>