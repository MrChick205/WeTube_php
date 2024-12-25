<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .add-btn{
    background-color: #d9534f;
    color: white;         
    border: none;          
    padding: 5px 10px;     
    border-radius: 5px; 
    cursor: pointer;      
    font-size: 14px;  
    }

    /* CSS cho table"*/
    .table {
        table-layout: fixed;
        width: 100%;
        border: 2px solid black; 
        border-collapse: collapse;
    }

    .table th, .table td {
        white-space: nowrap; 
        overflow: hidden; 
    }
    
    .threedots {
        text-overflow: ellipsis;  /*Hiển thị dấu "..." nếu nội dung quá dài */
    }

    /* CSS cho tableProduct"*/
    #movieTable th:nth-child(1), #movieTable td:nth-child(1) {
        width: 40px; 
    }

    #movieTable th:nth-child(2), #movieTable td:nth-child(2) {
        width: 200px; 
    }

    #movieTable  th:nth-child(4),  #movieTable  td:nth-child(4){
        width: 130px;
    }

    #movieTable  th:nth-child(6),  #movieTable  td:nth-child(6){
        width: 130px;
    }

    #movieTable th:nth-child(7),  #movieTable td:nth-child(7){
        width: 100px;
    }

    .btn_ud button {
        display: block; 
        margin-bottom: 10px;
        width: 80px;
    }

    .img-thumbnail {
        height:100px;
    }

</style>
<body>
    <div class="main-content">
        <div id="movieManagement" class="hidden">
            <h1 class="text-center">Movie management</h1>
            <button id="createMovieBtn" class="add-btn btn my-3">Add</button>
            <table id="movieTable" class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Movie URL</th>
                        <th>Poster</th>
                        <th>Description</th>
                        <th>Create_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="movieTableBody">
                    <!-- <?php
                        if (empty($movieitems)) {
                            echo "<tr><td colspan='7' class='text-center'>No movies found.</td></tr>";
                        } else {
                            foreach ($movieitems as $movieitem) {
                                echo "
                                <tr>
                                    <th scope='row'>{$movieitem->movieId}</th>
                                    <td>{$movieitem->movieTitle}</td>
                                    <td>{$movieitem->movie_url}</td>
                                    <td>
                                        <img src='{$movieitem->poster}' class='img-thumbnail' alt='Image of {$movieitem->movieTitle}'>
                                    </td>
                                    <td>{$movieitem->description}</td>
                                    <td>{$movieitem->create_at}</td>
                                    <td>
                                        <button type='button' class='updatebtn btn-warning btn' onclick='updateMovieItem({$movieitem->movieId})'>Update</button>
                                        <button type='button' class='deletebtn btn-danger btn' onclick='deleteMovieItem({$movieitem->movieId})'>Delete</button>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?> -->
                    <tr>
                        <th scope='row'>1</th>
                        <td>halo</td>
                        <td>olll</td>
                        <td>
                            <img src='https://phimimg.com/upload/vod/20241120-1/05e935ee1659e79b7c50e9c8346aa2b1.jpg' class='img-thumbnail' alt='Image of {$movieitem->movieTitle}'>
                        </td>
                        <td>hgsdhufgyugwfyugfw</td>
                        <td>301202</td>
                        <td>
                            <div class="btn_ud">
                                <button type='button' class='updatebtn btn-warning btn'>Update</button>
                                <button type='button' class='deletebtn btn-danger btn'>Delete</button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th scope='row'>1</th>
                        <td>halo</td>
                        <td>olll</td>
                        <td>
                            <img src='https://phimimg.com/upload/vod/20241120-1/05e935ee1659e79b7c50e9c8346aa2b1.jpg' class='img-thumbnail' alt='Image of {$movieitem->movieTitle}'>
                        </td>
                        <td>hgsdhufgyugwfyugfw</td>
                        <td>301202</td>
                        <td>
                            <button type='button' class='updatebtn btn-warning btn'>Update</button>
                            <button type='button' class='deletebtn btn-danger btn'>Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

