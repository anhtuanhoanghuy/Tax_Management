<?php
// Khởi tạo session
session_start();

// Kiểm tra xem người dùng có đăng nhập không
if (isset($_SESSION['account'])) {
    // Xóa tất cả biến trong session
    session_unset();
    
    // Hủy session
    session_destroy();
    
    // Chuyển hướng về trang chủ hoặc trang đăng nhập
    header("Location: /Tax_Management");
    exit();
}
?>