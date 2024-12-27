<?php 
    require_once('C:\xampp\htdocs\WeTube_php\app\controllers\movie.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
    background-color: black;
}

.main-content {
    padding: 30px 50px;
}

.add-btn {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

/* CSS cho table */
.table {
    table-layout: fixed;
    width: 100%;
    border: 2px solid black;
    border-collapse: collapse;
}

.table th, .table td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;    
    vertical-align: middle;
    padding: 10px;
}

#movieTable th:nth-child(5), #movieTable td:nth-child(5) {
    text-align: left;   
    vertical-align: top;  
    white-space: normal;  
    word-wrap: break-word; 
}

#movieTable th:nth-child(3), #movieTable td:nth-child(3) {
    white-space: normal;  
    word-wrap: break-word;
}

#movieTable th:nth-child(2), #movieTable td:nth-child(2) {
    width: 200px;
    white-space: normal;
    word-wrap: break-word;
}

#movieTable th:nth-child(6), #movieTable td:nth-child(6) {
    width: 130px;
    white-space: normal; 
    word-wrap: break-word;
}

#movieTable th:nth-child(1), #movieTable td:nth-child(1) {
    width: 40px;
}

#movieTable th:nth-child(2), #movieTable td:nth-child(2) {
    width: 200px;
}

#movieTable th:nth-child(3), #movieTable td:nth-child(3) {
    width: 250px;
}

#movieTable th:nth-child(4), #movieTable td:nth-child(4) {
    width: 130px;
}

#movieTable th:nth-child(5), #movieTable td:nth-child(5) {
    width: 300px;
}

#movieTable th:nth-child(6), #movieTable td:nth-child(6) {
    width: 130px;
}

#movieTable th:nth-child(7), #movieTable td:nth-child(7) {
    width: 150px;
}

.btn_ud button {
    display: block;
    margin-bottom: 10px;
    width: 100px;
}

.img-thumbnail {
    height: 100px;
}

.text-center {
    color: white;
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
                <?php
                // Kiểm tra nếu có dữ liệu
                if (!empty($movieitems)) {
                    foreach ($movieitems as $movieitem) {
                        echo "
                            <tr>
                                <td>{$movieitem['movie_id']}</td>
                                <td>{$movieitem['title']}</td>
                                <td>{$movieitem['movie_url']}</td>
                                <td><img src='{$movieitem['poster']}' class='img-thumbnail' alt='Image of {$movieitem['title']}'></td>
                                <td>{$movieitem['description']}</td>
                                <td>{$movieitem['created_at']}</td>
                                <td>
                                    <button type='button' class='btn btn-warning'>Update</button>
                                    <button type='button' class='btn btn-danger'>Delete</button>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No movies found.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

