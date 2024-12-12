<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/profile.css">
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
max-width: 1480px;
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

span {
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
    padding: 20px;
    border-radius: 8px;

}
.content h2 {
    margin-bottom: 20px;
}
.upload {
    width: 200px;
    height:200px;
    border: 2px dashed #ccc;
    border-radius: 50%;
    overflow: hidden; 
    margin: 20px auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload img {
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.camera-icon {
    position: absolute; 
    top: 250px;  
    right: 36%; 
    background-color: rgba(255, 255, 255, 0.7); 
    border-radius: 50%; 
    padding: 5px; 
    cursor: pointer; 
}

.form_inf {
  margin-left:20%;
}

.mb-3 {
    margin-bottom: 15px;
}
.mb-3 label {
    font-size: 20px;
    display: block;
    margin-bottom: 5px;
}
.mb-3 input {
    font-size: 20px;
    width: 75%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-update {
    font-size: 20px;
    background-color: #eeea04;
    color: rgb(0, 0, 0);
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer; 
    margin-left:66%;
}
.btn-update:hover {
    background-color: #218838;
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
        <form action="" method="POST">
            <div class="upload">
                <?php if (!empty($user['image'])): ?>
                <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="User Avatar" id="profileImage">
                <?php endif; ?>
                <div class="camera-icon" onclick="createFileInput();">
                    <i class="fa fa-camera" aria-hidden="true" style="font-size:28px"></i>
                </div>
            </div>
            <hr>
            <div class="form_inf">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="text" id="password" value="<?php echo htmlspecialchars($user['password']); ?>" class="form-control">
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
        const dropdowns = document.querySelectorAll('.sidebar_2');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    }
});

function createFileInput() {
    // Tạo một trường nhập liệu tệp mới
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*';
    
    // Thêm sự kiện onchange để xử lý hình ảnh
    fileInput.onchange = function(event) {
        loadImage(event);
    };

    // Kích hoạt click để mở hộp thoại chọn tệp
    fileInput.click();
}

function loadImage(event) {
    const img = document.getElementById('profileImage');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        img.src = e.target.result; // Cập nhật ảnh hồ sơ với hình ảnh mới
    };
    
    if (file) {
        reader.readAsDataURL(file);
    } else {
        img.src = ''; // Xóa hình ảnh nếu không có tệp nào được chọn
    }
}
</script>
</body>
</html>