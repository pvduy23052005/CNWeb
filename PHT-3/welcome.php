<?php
// TODO 1: Khởi động session (BẮT BUỘC ở mọi trang cần dùng SESSION)
session_start();

// TODO 2: Kiểm tra xem SESSION (lưu tên đăng nhập) có tồn tại không?
// Kiểm tra sự tồn tại của biến $_SESSION['logged_user']
if (isset($_SESSION['logged_user'])) {

  // TODO 3: Nếu tồn tại, lấy username từ SESSION ra
  $loggedInUser = $_SESSION['logged_user'];

  // Bắt đầu output HTML
  echo "<!DOCTYPE html>
<html lang=\"vi\">
<head>
    <meta charset=\"UTF-8\">
    <title>Chào mừng</title>
</head>
<body>";

  // TODO 4: In ra lời chào mừng
  echo "<h1>Chào mừng trở lại, $loggedInUser!</h1>";

  echo "<p>Bạn đã đăng nhập thành công.</p>";

  // TODO 5: (Tạm thời) Tạo 1 link để "Đăng xuất" (chỉ là quay về login.html)
  echo '<p><a href="login.html">Đăng xuất (Tạm thời)</a></p>';

  // Kết thúc output HTML
  echo "</body>
</html>";
} else {
  // TODO 6: Nếu không tồn tại SESSION (chưa đăng nhập)
  // Chuyển hướng người dùng về trang login.html
  header('Location: login.html?redirect=auth');
  exit;
}
