<?php
// Cấu hình kết nối Database
$host = 'localhost';
$db   = 'buoi2_php';
$user = 'root';
$port = '3307';
$pass = ''; 
$charset = 'utf8mb4'; // để hỗ trợ tiếng Việt

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

$message = "";

// Xu lý khi biểu mẫu được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Chuẩn bị câu lệnh INSERT (Sử dụng Prepared Statement để bảo mật)
            $sql = "INSERT INTO students (email, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $hashed_password]);

            $message = "<p style='color: green;'>Đăng ký thành công!</p>";
        } catch (PDOException $e) {
            $message = "<p style='color: red;'>Lỗi: " . $e->getMessage() . "</p>";
        }
    } else {
        $message = "<p style='color: orange;'>Vui lòng nhập đầy đủ thông tin.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký thành viên</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>
    
    <?php echo $message; ?>

    <form method="POST" action="register.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Đăng ký</button>
        <a href="login.php"><button type="button">Đăng nhập</button></a>
    </form>
</body>
</html>