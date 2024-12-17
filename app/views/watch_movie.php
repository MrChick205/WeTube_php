<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/asset/css/watch_movie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="movie_banner">
            <iframe 
            src="<?php echo $movie['movie_url']; ?>" frameborder="0" width="100%" height="600px" allowfullscreen>
        </iframe>
        </div>
        <div class="head">
            <div class="title">
                <h1><?php echo $movie['title']; ?></h1>
            </div>
            <div class="icon">
                <form method="post">
                    <div class="heart_icon">
                        <button type="submit" name="favorite"><i class="bi bi-heart-fill"></i></button>    
                    </div>
                    <div class="num_heart">
                        <p>1000</p>
                    </div>
                    <div class="collection_icon">
                        <button type="submit" name="collection"><i class="fa fa-bookmark-o"></i></button>
                    </div> 
                </form>   
            </div>
        </div>
        
        <div class="describe">
            <div class="image">
                <img src="<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?>">
            </div>
            <div class="text">
                <?php echo $movie['description']; ?>
            </div>
        </div>
        <div class="comment">
            <div class="num_cmt">
                <h2>2 Comment</h2>
                <div class="text_cmt">
                    <img src=" https://vapa.vn/wp-content/uploads/2022/12/anh-dai-dien-dep-001.jpg" class= "avarta" alt="">
                    <div class="content">
                        <form method="post">
                            <!-- <textarea name="" id=""></textarea> -->
                            <input type="text" name="comment_text" placeholder="Nhập bình luận">
                            <div class="button_cmt">
                                <button class="cancel"> Cancel</button>
                                <button type="submit" name="comment">Comment</button>
                            </div>
                        </form>
                    </div>
                
                </div>
                <div class="show_cmt">
                    <img class= "ano_avarta" src="https://chiemtaimobile.vn/images/companies/1/%E1%BA%A2nh%20Blog/avatar-facebook-dep/top-36-anh-dai-dien-dep-cho-nu/anh-dai-dien-dep-cho-nu-che-mat-anime.jpg?1708401649581" alt="">
                    <?php while ($row = $comments->fetch_assoc()) { ?>
                        <div class="show_content">
                            <div class="name_user">
                                <p><b><?php echo $row['user_name']; ?>:</b></p>
                            </div>
                            <p><?php echo $row['comment']; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>