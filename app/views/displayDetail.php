<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\controllers\movie.php';
// // Lấy thông tin phim từ controller
// $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Lấy movie_id từ URL (vd: detail.php?id=1)
// $movie = $moviectrll->getMovie($movie_id);

// // Nếu không tìm thấy phim, hiển thị thông báo lỗi
// if (!$movie || is_string($movie)) {
//     echo "<p>Không tìm thấy thông tin phim.</p>";
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Detail Display</title>
</head>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
<style>
.img_card {
    margin-bottom: 10px;
}
</style>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="movie_card col-md-4">
                <div class="img_card">
                    <img src="<?= htmlspecialchars( $movie['poster']) ?>" class="img-fluid" alt="Movie Image">
                </div>
               <div class="btn_movie">
                <a href="watch_movie.php?id=<?= $movie['movie_id'] ?>" class="btn_dpl btn btn-danger"><ion-icon name="caret-forward-outline" style="font-size: 24px;"></ion-icon>Xem phim</a>
               </div>
            </div>
            <div class="col-md-8">
                <h1><?= htmlspecialchars( $movie['title']) ?></h1>
                <p>describle</p>
                <p><?= htmlspecialchars($movie['description']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Similar movies</h2>
            </div>
            <div class="col-3">
                <div class="card">
                    <img src="https://phimimg.com/upload/vod/20241114-1/b145f04a857ff4f425308b1592da0cf0.jpg" class="card-img-top" alt="Movie 1">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title 1</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-1Z5bWn0Q3uHq0v3C5G6o74zQ6T1T4p1cl8k6D2jJ4hU5e9G5s2W0T5QwEBRz3A5R" crossorigin="anonymous"></script>
</body>
</html>