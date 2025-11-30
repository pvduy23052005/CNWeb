<?php
// === KẾT NỐI ===
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

// === XỬ LÝ THÊM SINH VIÊN ===
$message = ""; // Biến hiển thị thông báo

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ten_sinh_vien'])) {
    
    $ten = trim($_POST['ten_sinh_vien']);
    $email = trim($_POST['email']);
    
    if (empty($ten) || empty($email)) {
        $message = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        try {
            $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$ten, $email]);
            
            $message = "✅ Thêm sinh viên thành công!";
            
            // Chuyển hướng sau 1 giây
            header("Refresh: 1; url=index.php");
            
        } catch (PDOException $e) {
            $message = "Lỗi: " . $e->getMessage();
        }
    }
}

try {
    $sql_select = "SELECT * FROM sinhvien ORDER BY ngay_tao DESC";
    $stmt_select = $pdo->query($sql_select);
    $sinhvien_list = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi SELECT: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background: #0056b3;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background: #007bff;
            color: white;
        }
        
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        tr:hover {
            background: #e9ecef;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Quản lý Sinh Viên</h2>
        
        <!-- THÔNG BÁO -->
        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, '') !== false ? 'success' : 'error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <!-- FORM THÊM -->
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="ten_sinh_vien">Tên sinh viên:</label>
                <input type="text" id="ten_sinh_vien" name="ten_sinh_vien" 
                       placeholder="Nhập tên sinh viên" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" 
                       placeholder="Nhập email" required>
            </div>
            
            <button type="submit">Thêm sinh viên</button>
        </form>
        
        <!-- BẢNG DANH SÁCH -->
        <h3 style="margin-top: 30px;">Danh sách Sinh Viên</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sinh viên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($sinhvien_list) > 0): ?>
                    <?php foreach ($sinhvien_list as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['ten_sinh_vien']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['ngay_tao']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-data">Chưa có sinh viên nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <p style="margin-top: 20px; text-align: center; color: #666;">
            <strong>Tổng số:</strong> <?= count($sinhvien_list) ?> sinh viên
        </p>
    </div>
</body>
</html>