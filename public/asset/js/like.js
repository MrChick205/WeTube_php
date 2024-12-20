// Chuyển màu khi nhấn vào trái tim
document.querySelector('.heart_icon').addEventListener('click', function() {
    this.classList.toggle('active'); // Chuyển màu đỏ khi nhấn
    var likeCountElement = document.getElementById('likeCount');
    var currentCount = parseInt(likeCountElement.textContent);
    
    // Nếu đã thích thì tăng lượt yêu thích
    if (this.classList.contains('active')) {
        likeCountElement.textContent = currentCount + 1;
    } else {
        likeCountElement.textContent = currentCount - 1;
    }
});