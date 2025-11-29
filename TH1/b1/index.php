<?php include 'data.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Hoa Đẹp</title>

</head>
<body>

<h1> Bộ sưu tập hoa đẹp</h1>

<?php foreach ($flowers as $f): ?>
<div class="flower">
    <h2><?= $f["name"] ?></h2>
    <img src="hoadep/<?= $f["image"] ?>">
    <p><?= $f["desc"] ?></p>
</div>
<?php endforeach; ?>

</body>
</html>
<?php
$flowers = [];
$path = 'hoadep/';

$files = scandir($path);

foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {

        // Tạo tên hoa từ tên file (ví dụ: haiduong → Hoa Hai Duong)
        $name = pathinfo($file, PATHINFO_FILENAME);
        $name = ucwords(str_replace("-", " ", str_replace("_", " ", $name)));

        $flowers[] = [
            "name" => "Hoa " . $name,
            "desc" => "Mô tả đang cập nhật...",
            "image" => $file
        ];
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Quản trị hoa</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        img { width: 80px; }
    </style>
</head>
<body>

<h1>Trang quản trị - CRUD hoa</h1>
<a href="add.php"> Thêm hoa</a><br><br>

<table>
    <tr>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Mô tả</th>
        <th>Thao tác</th>
    </tr>

    <?php foreach ($flowers as $i => $f): ?>

    <tr>
        <td><img src="hoadep/<?= $f["image"] ?>"></td>
        <td><?= $f["name"] ?></td>
        <td><?= $f["desc"] ?></td>
        <td>
            <a href="edit.php?id=<?= $i ?>">Sửa</a> |
            <a href="delete.php?id=<?= $i ?>" onclick="return confirm('Xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
