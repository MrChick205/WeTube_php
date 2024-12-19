<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\controllers\movie.php';

// Lấy movie_id từ URL
if (isset($_GET['movie_id'])) {
    $movieId = intval($_GET['movie_id']);
    $movie = $moviectrll->getMovie($movieId);
} else {
    // Nếu không có movie_id, có thể chuyển hướng hoặc hiển thị thông báo
    die("Movie ID is required.");
}
// $movieId = 1;
// $movie = $moviectrll->getMovie($movieId);

// Lấy danh sách phim tương tự (cùng chủ đề)
$type_id = $movie['type_id'];
$similar_movies = $moviectrll->getMoviesByType($type_id);
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
                    <a href="watch_movie.php?movie_id=<?= $movie['movie_id'] ?>" class="btn_dpl btn btn-danger"><ion-icon name="caret-forward-outline" style="font-size: 24px;"></ion-icon>Xem phim</a>
               </div>
            </div>
            <div class="col-md-8">
                <h1><?= htmlspecialchars( $movie['title']) ?></h1>
                <p><strong>Description:</strong></p>
                <p><?= htmlspecialchars($movie['description']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Similar movies</h2>
            </div>
            <?php if (is_array($similar_movies) && !empty($similar_movies)): ?>
                <?php foreach ($similar_movies as $similar_movie): ?>
                    <?php if ($similar_movie['movie_id'] != $movieId): // Loại trừ phim hiện tại ?>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="<?= htmlspecialchars($similar_movie['poster']) ?>" class="card-img-top" alt="<?= htmlspecialchars($similar_movie['title']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($similar_movie['title']) ?></h5>
                                    <a href="watch_movie.php?movie_id=<?= $movie['movie_id'] ?>" class="btn_dpl btn btn-danger"><ion-icon name="caret-forward-outline" style="font-size: 24px;"></ion-icon>Xem phim</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có phim tương tự nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-1Z5bWn0Q3uHq0v3C5G6o74zQ6T1T4p1cl8k6D2jJ4hU5e9G5s2W0T5QwEBRz3A5R" crossorigin="anonymous"></script>
</body>
</html>