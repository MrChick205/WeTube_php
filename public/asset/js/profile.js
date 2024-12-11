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
