<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    // khởi tạo biến cart là một mảng rỗng: []= hay array_push
}

// danh sách sản phẩm 
$products = [
    1 => ['name' => 'Laptop Dell XPS', 'price' => 1500],
    2 => ['name' => 'iPhone 15 Pro', 'price' => 1200],
    3 => ['name' => 'Bàn phím cơ AKKO', 'price' => 100],
    4 => ['name' => 'Chuột Logitech G502', 'price' => 50]
];

// 3. Xử lý khi bấm nút "Thêm vào giỏ"
if (isset($_GET['add_id'])) {
    $id = $_GET['add_id'];
    
    // Kiểm tra ID có tồn tại trong danh sách sản phẩm không
    if (array_key_exists($id, $products)) {
        // Thêm ID vào mảng VD: [1,2] ==> chạy lệnh với $id = 3 ==> [1,2,3]
        $_SESSION['cart'][] = $id;
        // Chuyển hướng lại trang giỏ hàng để tránh việc thêm nhiều lần khi refresh
        header("Location: cart.php");
        exit(); // Quan trọng: tránh việc một lần thêm nhiều sản phẩm khi refresh
    }
}

// 4. Xử lý xóa giỏ hàng
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng đơn giản</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-bottom: 20px; }
        th, td { border: 1px solid #ff2323; padding: 8px; text-align: left; }
        .cart-section { background: #53f6ff; padding: 15px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2>Danh sách sản phẩm</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($products as $id => $info): ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $info['name']; ?></td>
            <td>$<?php echo $info['price']; ?></td>
            <td>
                <a href="cart.php?add_id=<?php echo $id; ?>">
                    <button type="button">Thêm vào giỏ</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="cart-section">
        <h3>Giỏ hàng của bạn</h3>
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Giỏ hàng đang trống.</p>
        <?php else: ?>
            <ul>
                <?php 
                // vòng lặp duyệt qua mảng chứa ID mà người dùng đã thêm vào giỏ
                foreach ($_SESSION['cart'] as $item_id) {
                    
                    echo "<li>Sản phẩm ID: " . $item_id . " - " . $products[$item_id]['name'] . "</li>";
                }
                ?>
            </ul>
            <p><a href="cart.php?clear=1">Xóa</a></p>
        <?php endif; ?>
    </div>
</body>
</html>