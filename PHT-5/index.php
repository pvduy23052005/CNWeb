<?php
// Tệp Controller là "não" của ứng dụng

// TODO 6: (Quan trọng) Import (require_once) tệp Model vào
require_once 'models/SinhVienModel.php';


// === THIẾT LẬP KẾT NỐI PDO ===
// TODO 7: Copy code PDO từ PHT Chương 4 vào đây
$host = '127.0.0.1';
$dbname = 'cse485';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Kết nối thất bại: " . $e->getMessage());
}
// === KẾT THÚC KẾT NỐI PDO ===


// === LOGIC CỦA CONTROLLER ===

// TODO 8: Kiểm tra xem có hành động POST (thêm sinh viên) không
// Gợi ý: Dùng isset($_POST['ten_sinh_vien'])
if (isset($_POST['ten_sinh_vien']) && isset($_POST['email'])) {

  // TODO 9: Nếu có, lấy $ten và $email từ $_POST
  $ten = trim($_POST['ten_sinh_vien']);
  $email = trim($_POST['email']);

  // TODO 10: Gọi hàm addSinhVien() từ Model
  // (Truyền $pdo, $ten, $email vào hàm)
  addSinhVien($pdo, $ten, $email);

  // TODO 11: Chuyển hướng về index.php để "làm mới" trang (PRG Pattern)
  header('Location: index.php');
  exit;
}


// TODO 12: (Luôn luôn) Gọi hàm getAllSinhVien() từ Model
// (Truyền $pdo vào hàm)
// Lưu kết quả trả về vào một biến, ví dụ: $danh_sach_sv
$danh_sach_sv = getAllSinhVien($pdo);


// TODO 13: (Rất quan trọng) Import (include) tệp View ở cuối cùng
// Tệp View sẽ tự động "nhìn thấy" biến $danh_sach_sv mà ta vừa tạo
include 'views/sinhvien_view.php';
