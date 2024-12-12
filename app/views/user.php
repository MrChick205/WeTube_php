<?php
require_once '../config/connect.php';
require_once '../controllers/user.php';

// Khởi tạo controller
$userController = new UserController($conn);

// Giả sử ID người dùng được truyền qua URL (ví dụ: profile.php?id=1)
$userId = $_GET['id'] ?? 1; // Mặc định là 1 nếu không có ID

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile Container</title>
</head>
<body>

<div class="container">
    <div class="sidebar" style="width: 280px;">
        <div class="sidebar_item" id="sidebar_Home">
            <a href="/" class="">
                <i class="fa fa-home" style="font-size:24px"></i>
                <span class="">Home</span>
            </a>
        </div>
        <div class="sidebar_item" id="sidebar_Account">
            <a href="/" class="">
                <i class="fa fa-cog" style="font-size:24px"></i>
                <span>Account Setting</span>
            </a>
        </div>
    </div>

    <div id="profile_info">
        <h2>Your Profile</h2>
        
        <!-- Hiển thị thông tin người dùng -->
        <div id="userProfile">
            <div class="upload">
                <?php if (!empty($user['image'])): ?>
                    <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="User Avatar" id="profileImage">
                <?php else: ?>
                    <p>No image available. Click to upload a new image.</p>
                <?php endif; ?>
            </div>
            <div class="form_inf">
                <div class="mb-3">
                    <label>Username:</label>
                    <p><?php echo htmlspecialchars($user['user_name']); ?></p>
                </div>
                <div class="mb-3">
                    <label>Email:</label>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="mb-3">
                    <label>Phone number:</label>
                    <p><?php echo htmlspecialchars($user['phone']); ?></p>
                </div>
                <button id="editButton" class="btn-update" onclick="toggleEditForm()">Edit Profile</button>
            </div>
        </div>

        <!-- Form chỉnh sửa thông tin người dùng -->
        <form id="editForm" action="" method="POST" enctype="multipart/form-data" style="display: none;">
            <div class="img_upload">
                <?php if (!empty($user['image'])): ?>
                    <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="User Avatar" id="profileImageEdit">
                <?php else: ?>
                    <p>No image available. Click to upload a new image.</p>
                    <div class="camera-icon" onclick="createFileInput();">
                        <i class="fa fa-camera" aria-hidden="true" style="font-size:28px"></i>
                    </div>
                <?php endif; ?>
            </div>
            <hr>
            <div class="form_inf">
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone">Phone number</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank if no change">
                </div>
                <div class="mb-3">
                    <label for="image">Profile Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                </div>
            </div> 
            <button type="submit" class="btn-update">Update Profile</button>
        </form> 
    </div>
</div>

<script>
   
    
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

    const upload = document.querySelector('.image-container');
    const fileInput = document.querySelector('.file-input');
    const img = document.querySelector('#img-user');


    imageContainer.addEventListener('click', () => {
    fileInput.click();
    });
    // Thay đổi ảnh khi user đổi
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
</script>

</body>
</html>