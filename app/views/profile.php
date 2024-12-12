<?php
session_start();
require_once '../config/connect.php';
require_once '../controllers/user.php';

// Khởi tạo controller
$userController = new UserController($conn);

$userId = $_SESSION['user_id']; 

// Lấy thông tin người dùng
$user = $userController->getUserProfile($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý cập nhật thông tin người dùng từ form
    $updated = $userController->updateUserProfile($userId);

    if ($updated) {
        echo "<div class='alert alert-success'>User updated successfully.</div>";
        // Cập nhật lại thông tin người dùng sau khi cập nhật
        $user = $userController->getUserProfile($userId);
    } else {
        echo "<div class='alert alert-danger'>Failed to update user.</div>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/asset/profile.css">
     <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Bootstrap icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile Container</title>
   
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
    background-color: #0f0e0e;
    margin: 0;
    padding: 0;
}
.container {
    display: flex;
    background-color: #181414;
    width: 100%;
    height:100vh;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

@media (min-width: 1200px) {
.container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1180px;
    }
}

.sidebar {
    width: 25%;
    background-color:#fff ;
    margin-right: 20px;
    color: #120202;
    padding: 20px;
    border-radius: 8px;
}

span, p {
    font-size: 20px;
}

.sidebar a {
    color: #080000;
    text-decoration: none;
    display: block;
    margin: 10px 0;
}

.sidebar_item ul {
    list-style-type: none; 
    display: none; 
}

.sidebar_item.active ul {
    display: block; 
}

#profile_info {
    background-color: #fff;
    width: 100%;
    padding: 10px;
    border-radius: 8px;

}
.content h2 {
    margin-bottom: 20px;
}
.img_upload {
    width: 180px;
    height:180px;
    border: 2px dashed #ccc;
    border-radius: 50%;
    overflow: hidden; 
    margin: 5px auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.img_upload img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.camera-icon {
    position: absolute; 
    top: 280px;  
    right: 34%; 
    background-color: rgba(255, 255, 255, 0.7); 
    border-radius: 50%; 
    padding: 5px; 
    cursor: pointer; 
}

.form_inf {
  margin-left:20%;
}

.mb-3 label {
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}
.mb-3 input {
    font-size: 16px;
    width: 75%;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-update, .btn-edit {
    font-size: 16px;
    background-color: #eeea04;
    color: rgb(0, 0, 0);
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer; 
}

.btn-update {
    margin-left:66%;
}

.btn-edit{
    margin-left: 30%;
    margin-top: 150px;
}

.btn-update:hover, .btn-edit:hover {
    background-color:rgb(249, 153, 8);
}


</style>
<body>

<div class="container">
    <div class="sidebar" style="width: 280px;">
      <div class="sidebar_item" id="sidebar_Home">
        <a href="/" class="">
          <i class="fa fa-home" style="font-size:24px"></i>
          <span class="">Home</span>
        </a>
      </div>

      <div class="sidebar_item" id="sidebar_Activity">
        <a href="javascript:void(0);" class="arrow">
          <i class="fa fa-snowflake-o" style="font-size:24px"></i>
          <span>Your activity</span>
          <span class="arrow">&#9660;</span>
        </a>
        <ul>
          <li>
            <a href="#" class="item" id="item_History">
              <i class="fa fa-history"></i>
              <span>History</span>
           </a>
          </li>
          <li>
            <a href="#" class="item" id="item_Like">
                <i class="fa fa-thumbs-up"></i>
              <span>Liked</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="sidebar_item" id="sidebar_Account">
        <a href="/" class="">
          <i class="fa fa-cog" style="font-size:24px"></i>
          <span>Account Setting</span>
        </a>
      </div>
    </div>
    <div id="profile_info" class="hidden">
        <h2>Your Profile</h2>

        <div id="userProfile">
            <div class="img_upload">
                <?php if (!empty($user['image'])): ?>
                    <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="User Avatar" id="profileImage">
                <?php else: ?>
                        <p>No image available.</p>
                <?php endif; ?>
            </div>
            <hr>
            <div class="form_inf">
                <div class="mb-3">
                    <p><strong>User name:</strong><?php echo htmlspecialchars($user['user_name']); ?></p>
                </div>
                <div class="mb-3">
                    <p><strong>Email:</strong><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="mb-3">
                    <p><strong>Birth:</strong><?php echo htmlspecialchars($user['birth']); ?></p>
                </div>
                <button id="editButton" class="btn-edit" onclick="toggleEditForm()">Edit Profile</button>
            </div>
        </div>

        <form id="editForm" action="" method="POST" enctype="multipart/form-data" style="display: none;">
            <div class="img_upload">
                <img id = "img-user"  name="user_img" src="<?php echo htmlspecialchars($user['image']); ?>" alt="User Avatar" class="image-user">
                <div class="camera-icon">
                    <i class="fa fa-camera" style="font-size:28px"></i>
                </div>
                <input type="file" name = "image" class="file-input" accept="image/*" style="display: none;">
            </div>
            <hr>
            <div class="form_inf">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="user_name"  value="<?php echo htmlspecialchars($user['user_name']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email"  name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="birth"></label>
                        <input type="date" id="birth"   name="birth" value="<?php echo htmlspecialchars($user['birth']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password"  name="password" value="<?php echo htmlspecialchars($user['password']); ?>" class="form-control">
                    </div>
            </div> 
            <button class="btn-update">Update Profile</button>
        </form> 
    </div>
</div>
<script>
    document.querySelector('.arrow').addEventListener('click', function() {
    this.parentElement.classList.toggle('active');
});

// Đóng danh sách khi nhấp ra ngoài
window.addEventListener('click', function(event) {
    if (!event.target.matches('.arrow')) {
        const dropdowns = document.querySelectorAll('#sidebar_Activity');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    }
});

    function toggleEditForm() {
        const userProfile = document.getElementById('userProfile');
        const editForm = document.getElementById('editForm');
        if (editForm.style.display === "none") {
            userProfile.style.display = "none";
            editForm.style.display = "block";
        } else {
            userProfile.style.display = "block";
            editForm.style.display = "none";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.file-input');
        const img = document.querySelector('#img-user');

        document.querySelector('.camera-icon').addEventListener('click', () => {
        fileInput.click(); // 
        });

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    img.src = e.target.result; // Thay đổi ảnh
                };
                reader.readAsDataURL(file);
            }
        });
    });


</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>