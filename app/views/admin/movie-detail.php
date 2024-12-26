<?php
require_once __DIR__ . '/../../controllers/movie.php';

require_once __DIR__ . '/../../controllers/like.php';

// Lấy movie_id từ URL
// if (isset($_GET['movie_id'])) {
//     $movieId = intval($_GET['movie_id']);
//     $movie = $moviectrll->getMovie($movieId);
// } else {
//     die("Movie ID is required.");
// }


// if (isset($_GET['delete_comment_id']) && isset($_GET['movie_id'])) {
//     $commentId = intval($_GET['delete_comment_id']);
//     $movieId = intval($_GET['movie_id']);
//     $result = $moviectrll->deleteComment($commentId, $movieId);

//     // Hiển thị thông báo
//     echo "<script>alert('$result'); window.location.href='?movie_id=$movieId';</script>";
// }

// Gán cố định giá trị
$movieId = 1; 
$commentId = 1; 

// Lấy thông tin phim dựa trên movieId
$movie = $moviectrll->getMovie($movieId);

// Xóa bình luận với commentId cố định
$result = $moviectrll->deleteComment($commentId, $movieId);

// Hiển thị thông báo và chuyển hướng
echo "<script>alert('$result'); window.location.href='?movie_id=$movieId';</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?> - Watch Movie</title>
    <link rel="stylesheet" href="../../public/asset/css/watch_movie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
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
                    <div class="collection_icon">
                        <button type="submit" name="collection"><i class="fa fa-bookmark-o"></i></button>
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
                <?php foreach ($comments as $comment): ?>
                    <div class="show_cmt">
                        <img class="ano_avarta" src="https://chiemtaimobile.vn/images/companies/1/%E1%BA%A2nh%20Blog/avatar-facebook-dep/top-36-anh-dai-dien-dep-cho-nu/anh-dai-dien-dep-cho-nu-che-mat-anime.jpg?1708401649581" alt="">
                        <div class="show_content">
                            <div class="name_user">
                            <p><b><?php echo htmlspecialchars($comment['user_name']); ?></b></p>
                            </div>
                            <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                            <div>
                                <a href="?movie_id=<?php echo $movieId; ?>&delete_comment_id=<?php echo $comment['id']; ?>" 
                                    class="delete_comment" 
                                    onclick="return confirm('Bạn có chắc muốn xóa bình luận này?');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
    <script src="../../public/asset/js/like.js"></script>
</body>
</html>