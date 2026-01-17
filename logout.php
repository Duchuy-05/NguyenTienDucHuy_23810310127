<?php
session_start(); 

// Xóa toàn bộ dữ liệu trong session
session_unset(); // Giải phóng các biến session
session_destroy(); // Hủy bỏ session

// Chuyển hướng về trang đăng nhập
header("Location: login.php");
exit();