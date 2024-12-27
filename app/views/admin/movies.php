<?php 
    require_once('C:\xamppp\htdocs\Wetube\WeTube_php\app\controllers\movie.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add'])) {
            $moviectrll->addMovie($_POST['title'], $_POST['description'], $_POST['movie_url'], $_POST['type_id'], $_POST['poster']);
        } elseif (isset($_POST['update'])) {
            $moviectrll->updateMovie($_POST['movie_id'], $_POST['title'], $_POST['description'], $_POST['movie_url'], $_POST['type_id'], $_POST['poster']);
        } elseif (isset($_POST['delete'])) {
            $moviectrll->deleteMovie($_POST['movie_id']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    width: 200px;
}

#movieTable th:nth-child(5), #movieTable td:nth-child(5) {
    width: 300px;
}

#movieTable th:nth-child(6), #movieTable td:nth-child(6) {
    width: 130px;
}

/* #movieTable th:nth-child(7), #movieTable td:nth-child(7) {
    width: 150px;
} */

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

.btn-form button, input, a{
    display: flex;
    flex-direction: column;
    margin-bottom: 8px;
    width: 80px;
    margin-left: 30px;
    align-items: center;
}
</style>
<body>
    <div class="main-content">
        <div id="movieManagement" class="hidden">
            <h1 class="text-center">Movie management</h1>
            <button id="createMovieBtn" class="add-btn btn my-3" data-bs-toggle="modal" data-bs-target="#createMovieModal">Add</button>
            <table id="movieTable" class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Movie URL</th>
            <th>Poster</th>
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
                                <td>{$movieitem['created_at']}</td>
                                <td>
                                        <form method='POST' style='display:inline;' class='btn-form'>
                                            <input type='hidden' name='movie_id' value='{$movieitem['movie_id']}'>
                                            <button type='submit' name='update' class='btn btn-warning'>Update</button>
                                            <input type='submit' name='delete' class='btn btn-danger' value='Delete'>
                                            <a href='movie-detail.php?movie_id={$movieitem['movie_id']}' class='btn btn-danger'>Detail</a>
                                        </form>

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

        <!-- Modal for Create Movie -->
        <div class="modal fade" id="createMovieModal" tabindex="-1" aria-labelledby="createMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMovieModalLabel">Create Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createMovieForm">
                        <div class="mb-3">
                            <label for="movieTitle" class="form-label">Enter Movie Title</label>
                            <input type="text" class="form-control" id="movieTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="movieURL" class="form-label">Enter Movie URL</label>
                            <input type="url" class="form-control" id="movieURL" required>
                        </div>
                        <div class="mb-3">
                            <label for="moviePoster" class="form-label">Enter Poster URL</label>
                            <input type="url" class="form-control" id="moviePoster" required>
                        </div>
                        <div class="mb-3">
                            <label for="movieDescription" class="form-label">Enter Description</label>
                            <textarea class="form-control" id="movieDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="createdAt" class="form-label">Created At</label>
                            <input type="date" class="form-control" id="createdAt" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
