<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/asset/css/watch_movie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body{
        background-color: black;
        color: white;
    }
    .title{
        margin-left:100px;
    }
    .image img{
        width: 300px;
        height: 300px;
        object-fit: contain;
    }
    .describe{
        display: flex;
        margin-left: 50px;
    }
    .text{
        width: 600px;
    }
    .text_cmt{
        display: flex;
    }
    .avarta{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .content input {
        margin-left: 30px;
        width: 700px;
        padding: 30px;
        text-align: center;
        border-radius: 20px;
        border:none;
    }
    .show_cmt{
        display: flex;
        margin-top: 30px;
    }
    .ano_avarta{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .show_content{
        margin-left: 30px;

    }
    .name_user p{
        margin: 0px;
    }
    .button_cmt{
        display: flex;
        gap: 15px;
        margin-top: 10px;
        margin-left: 550px;
    }
    .cancel{
        padding: 5px 15px;
        border-radius: 15px;
        border: none;
    }
    .post_cmt{
        padding: 5px 15px;
        border-radius: 15px;
        background-color: #F9ED32;
        border: none;    
    }
    .comment{
        margin-left: 100px;
    }
    .icon{
        display: flex;
        margin-top: 30px;
        gap: 15px;
        font-size: 30px;
    }
    .icon p{
        margin: 0px;
    }
    .head{
        display: flex;
        gap: 700px
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="movie_banner">
            <iframe 
            src="https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241105/a3Y1CogJ/index.m3u8" frameborder="0" width="100%" 
            height="600px" allowfullscreen>
        </iframe>
        </div>
        <div class="head">
            <div class="title">
                <h1>Vẫn Mãi Là Em</h1>
            </div>
            <div class="icon">
                <div class="heart_icon">
                    <i class="bi bi-heart-fill"></i>    
                </div>
                <div class="num_heart">
                    <p>1000</p>
                </div>
                <div class="collection_icon">
                    <i class="fa fa-bookmark-o"></i>
                </div>    
            </div>
        </div>
        
        <div class="describe">
            <div class="image">
                <img src="https://phimimg.com/upload/vod/20241105-1/ff9b778b3f26b2b82af290a6b306c40f.jpg" alt="">
            </div>
            <div class="text">
                Bản remake từ She Was Pretty - bộ phim Hàn Quốc đình đám, dựa trên một câu chuyện có thật về mối quan hệ của một cặp đôi từ bạn thành yêu. Ploypailin là một cô gái xinh đẹp 
                xuất thân từ một gia đình giàu có. Sau khi công ty xuất bản của gia đình cô bị phá sản, cô đã trải qua những khó
                khăn và mất đi vẻ đẹp của mình. Kawin là một cậu bé xấu xí lại tự ti, nhưng lớn lên trở thành một biên tập viên đẹp trai và thành đạt.
                Hai người bạn thưở nhỏ quyết định gặp lại nhau khi trưởng thành. Vì xấu hổ về vẻ ngoài và sợ làm hỏng ký ức tốt đẹp của Kawin về mình, Ploypailin đã yêu cầu người bạn thân 
                xinh đẹp giả làm cô để gặp Kawin. Tuy nhiên, mọi thứ nhanh chóng trở nên phức tạp khi Ploypailin được chỉ định làm việc tại tạp chí nơi Kawin là phó tổng biên tập. Anh công khai ngược đãi và coi thường cô vì bản tính vụng về của cô, mà không biết rằng cô chính là người bạn thời thơ ấu của anh.
            </div>
        </div>
        <div class="comment">
            <div class="num_cmt">
                <h2>2 Comment</h2>
                <div class="text_cmt">
                    <img src=" https://vapa.vn/wp-content/uploads/2022/12/anh-dai-dien-dep-001.jpg" class= "avarta" alt="">
                    <div class="content">
                        <!-- <textarea name="" id=""></textarea> -->
                        <input type="text" value="">
                        <div class="button_cmt">
                            <button class="cancel"> Cancel</button>
                            <button class="post_cmt">Comment</button>
                        </div>
                    </div>
                
                </div>
                <div class="show_cmt">
                    <img class= "ano_avarta" src="https://chiemtaimobile.vn/images/companies/1/%E1%BA%A2nh%20Blog/avatar-facebook-dep/top-36-anh-dai-dien-dep-cho-nu/anh-dai-dien-dep-cho-nu-che-mat-anime.jpg?1708401649581" alt="">
                    <div class="show_content">
                        <div class="name_user">
                            <p><b>Hồ Thị Tiếp </b></p>
                        </div>
                        <p>Phim này hay quá. Ra tập tiếp theo đi nào</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>