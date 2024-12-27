<?php
require_once __DIR__ . '/../../controllers/movie.php';

require_once __DIR__ . '/../../controllers/like.php';

// Lấy movie_id từ URL
if (isset($_GET['movie_id'])) {
    $movieId = intval($_GET['movie_id']);
    $movie = $moviectrll->getMovie($movieId);
    $comments = $moviectrll->getCommentsByMovie($movieId); 
} else {
    die("Movie ID is required.");
}


if (isset($_GET['delete_comment_id']) && isset($_GET['movie_id'])) {
    $commentId = intval($_GET['delete_comment_id']);
    $movieId = intval($_GET['movie_id']);
    echo "Comment ID: $commentId, Movie ID: $movieId";
    $result = $moviectrll->deleteComment($commentId, $movieId);
    // Kiểm tra kết quả
    if ($result) {
        echo "<script>alert('Xóa bình luận thành công!'); window.location.href='?movie_id=$movieId';</script>";
    } else {
        echo "<script>alert('Xóa bình luận thất bại!'); window.location.href='?movie_id=$movieId';</script>";
    }
}
// Gán cố định giá trị
// $movieId = 1; 
// $commentId = 1; 
// $movie = $moviectrll->getMovie($movieId);
// $result = $moviectrll->deleteComment($commentId, $movieId);
// echo "<script>alert('$result'); window.location.href='?movie_id=$movieId';</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?> - Watch Movie</title>
    <link rel="stylesheet" href="../../../public/asset/css/watch_movie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    .box {
        display: inline-block;
    }

    .btn_dlcm {
            display: inline-block;
            margin-top: 10px;
        }
    .btn {
        padding: 10px 15px;
        border-radius: 5px;
        background-color: red;
        transition: background-color 0.3s;
    }

    .delete_comment {
        color: black;
        text-decoration: none; /* Xóa dấu gạch chân */
    }

    .btn:hover {
        background-color: darkred;
    }

</style>
<body>
    <div class="container">
        <div class="movie_banner">
            <iframe 
                src="<?php echo htmlspecialchars($movie['movie_url']); ?>" 
                frameborder="0" 
                width="100%" 
                height="600px" 
                allowfullscreen>
            </iframe>
        </div>
        <div class="head">
            <div class="title">
                <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
            </div>
            <div class="icon">
                <form method="post" class= "form_icon">
                    <div class="heart_icon" id="heart_icon">
                        <button type="submit" name="favorite">
                            <i class="bi bi-heart-fill"></i>
                        </button>    
                    </div>
                    <div class="num_heart">
                        <p><?php echo $likeCount; ?></p>
                    </div>
                </form>   
            </div>
        </div>
        
        <div class="describe">
            <div class="image">
                <img src="<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
            </div>
            <div class="text">
                <?php echo nl2br(htmlspecialchars($movie['description'])); ?>
            </div>
        </div>
        
        <div class="comment">
            <div class="num_cmt">
                <h2>2 Comments</h2>
                <div class="text_cmt">
                    <img src="https://vapa.vn/wp-content/uploads/2022/12/anh-dai-dien-dep-001.jpg" class="avarta" alt="">
                    <div class="content">
                        <form method="post">
                            <input type="text" name="comment_text" placeholder="Nhập bình luận">
                            <div class="button_cmt">
                                <button type="button" class="cancel">Cancel</button>
                                <button type="submit" name="comment">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="show_cmt">
                            <img class="ano_avarta" src="<?php echo !empty($comment['avatar']) ? htmlspecialchars($comment['avatar']) : 'uploads/default-avatar.png'; ?>" 
                            alt="Avatar">
                            <div class="show_content">
                                <div class="name_user">
                                    <p><b><?php echo htmlspecialchars($comment['user_name'] ?? 'Ẩn danh'); ?></b></p>
                                </div>
                                <div class="box">
                                    <div class="cnt">
                                        <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                                    </div>
                                    <div class="btn_dlcm btn btn-danger">
                                        <a href="?movie_id=<?php echo htmlspecialchars($movieId ?? '0'); ?>&delete_comment_id=<?php echo htmlspecialchars($comment['comment_id'] ?? '0'); ?>" 
                                            class="delete_comment" 
                                            onclick="return confirm('Bạn có chắc muốn xóa bình luận này?');">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Chưa có bình luận nào.</p>
                <?php endif; ?>
        </div>
    </div>
    <script src="../../public/asset/js/like.js"></script>
</body>
</html>