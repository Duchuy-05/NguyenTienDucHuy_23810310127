# 🚀 PHP Security & Session Management Project

Dự án này tập trung vào việc xây dựng luồng xác thực người dùng an toàn và quản lý dữ liệu phía máy chủ (Server-side) thông qua Session.

## ✨ Outstanding Features
- **Authentication:** Đăng ký/Đăng nhập hoàn chỉnh.
- **Security First:** - Mật khẩu được mã hóa chuẩn `BCRYPT`.
  - Sử dụng PDO để ngăn chặn tuyệt đối lỗi SQL Injection.
- **Session Handling:** - Bảo vệ trang `dashboard.php`, tự động chuyển hướng nếu chưa đăng nhập.
  - Giỏ hàng thông minh lưu trữ trong mảng Session, dữ liệu không bị mất khi F5.

## 🛠 Technology Used
- **Backend:** PHP 8.x
- **Database:** MySQL
- **Frontend:** HTML5, CSS3

## 📦 Setting
1. Clone dự án: `git clone https://github.com/Duchuy-05/ten-repo-cua-ban.git`
2. Tạo database `buoi2_php` và chạy lệnh SQL sau:
   ```sql
   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       email VARCHAR(255) UNIQUE,
       password VARCHAR(255)
   );
