<?php
session_start();

// Check quyền truy cập
if (!isset($_SESSION['user'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit(); // Đảm bảo không tiếp tục thực thi mã sau khi chuyển hướng !important
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị</title>
</head>
<body>
    <h1>Trang quản trị hệ thống</h1>
    
    <p>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong></p>
    
    <hr>
    
    <form action="logout.php" method="POST">
        <button type="submit">Đăng xuất</button>
    </form>

</body>
</html>