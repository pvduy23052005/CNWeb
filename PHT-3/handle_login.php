<?php
// TODO 1: (Cực kỳ quan trọng) Khởi động session
// Phải gọi hàm này TRƯỚC BẤT KỲ output HTML nào
session_start();
 
// TODO 2: Kiểm tra xem người dùng đã nhấn nút "Đăng nhập" (gửi form) chưa
// Kiểm tra sự tồn tại của $_POST['username'] để xác định yêu cầu POST từ form
if (isset($_POST['username'])) {
 
    // TODO 3: Nếu đã gửi form, lấy dữ liệu 'username' và 'password' từ $_POST
    $user = $_POST['username'];
    $pass = $_POST['password'];
 
    // TODO 4: (Giả lập) Kiểm tra logic đăng nhập
    // Nếu $user == 'admin' VÀ $pass == '123' thì là đăng nhập thành công
    if ($user == 'admin' && $pass == '123') {
        
        // TODO 5: Nếu thành công, lưu tên username vào SESSION
        // Lưu trữ tên người dùng vào biến $_SESSION['logged_user']
        $_SESSION['logged_user'] = $user;
 
         // TODO 6: Chuyển hướng người dùng sang trang "chào mừng"
        // Chuyển hướng trình duyệt đến welcome.php
        header('Location: welcome.php');
        // Luôn gọi exit() ngay sau khi dùng header()
        exit;
    } else {
        // Nếu thất bại, chuyển hướng về login.html
        header('Location: login.html?error=1'); 
        exit;
    }
} else {
    // TODO 7: Nếu người dùng truy cập trực tiếp file này (không qua POST),
    // "đá" họ về trang login.html
    header('Location: login.html');
    exit;
}
?>