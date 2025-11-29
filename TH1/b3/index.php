<?php
$filename = "./data/65HTTT_Danh_sach_diem_danh.csv";

// Kiểm tra file tồn tại
if (!file_exists($filename)) {
  die("Không tìm thấy file CSV tại: $filename");
}

$rows = [];

// Đọc file CSV
if (($handle = fopen($filename, "r")) !== false) {
  while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    $rows[] = $data;
  }
  fclose($handle);
}

// Tách header và data
$header = array_shift($rows);
$totalStudents = count($rows);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách điểm danh 65HTTT</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 20px;
      min-height: 100vh;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    h1 {
      text-align: center;
      color: #667eea;
      margin-bottom: 10px;
      font-size: 2em;
    }

    .info-box {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    .info-box strong {
      color: #667eea;
      font-size: 1.2em;
    }

    .table-wrapper {
      overflow-x: auto;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }

    thead {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    th {
      padding: 15px;
      text-align: left;
      font-weight: bold;
      font-size: 0.95em;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    td {
      padding: 12px 15px;
      border-bottom: 1px solid #e0e0e0;
    }

    tbody tr {
      transition: all 0.3s;
    }

    tbody tr:hover {
      background: #f0f4ff;
      transform: scale(1.01);
    }

    tbody tr:nth-child(even) {
      background: #f8f9fa;
    }

    tbody tr:nth-child(even):hover {
      background: #f0f4ff;
    }

    .row-number {
      font-weight: bold;
      color: #667eea;
      text-align: center;
    }

    .student-id {
      font-family: 'Courier New', monospace;
      color: #495057;
      font-weight: 600;
    }

    .attendance {
      text-align: center;
    }

    .attendance.present {
      color: #28a745;
      font-weight: bold;
    }

    .attendance.absent {
      color: #dc3545;
      font-weight: bold;
    }

    .search-box {
      margin-bottom: 20px;
    }

    .search-box input {
      width: 100%;
      padding: 12px 20px;
      border: 2px solid #e0e0e0;
      border-radius: 25px;
      font-size: 1em;
      transition: all 0.3s;
    }

    .search-box input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
    }

    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }

      h1 {
        font-size: 1.5em;
      }

      th,
      td {
        padding: 8px;
        font-size: 0.9em;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Danh sách điểm danh lớp 65HTTT</h1>

    <div class="info-box">
      Tổng số sinh viên: <strong><?= $totalStudents ?></strong> người
    </div>


    <div class="table-wrapper">
      <table id="dataTable">
        <thead>
          <tr>
            <th style="width: 60px;">STT</th>
            <?php foreach ($header as $col): ?>
              <th><?= htmlspecialchars($col) ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $index => $row): ?>
            <tr>
              <td class="row-number"><?= $index + 1 ?></td>
              <?php foreach ($row as $colIndex => $cell): ?>
                <?php
                // Xác định class cho từng cột
                $class = '';
                $cellValue = htmlspecialchars($cell);

                // Nếu là cột mã sinh viên (thường là cột đầu)
                if ($colIndex == 0) {
                  $class = 'student-id';
                }

                // Nếu là cột điểm danh
                if (strtolower($cell) == 'x' || strtolower($cell) == 'có') {
                  $class = 'attendance present';
                  $cellValue = '✓';
                } elseif (strtolower($cell) == 'vắng' || strtolower($cell) == '') {
                  $class = 'attendance absent';
                  $cellValue = '✗';
                }
                ?>
                <td class="<?= $class ?>"><?= $cellValue ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>


</body>

</html>