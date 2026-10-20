<?php
// 2. Viết hàm calculateAverage() tính điểm trung bình
function calculateAverage(float $midterm, float $final): float {
    return ($midterm + $final) / 2;
}

// 1. Tạo mảng $students gồm 3 sinh viên với name, midterm, final
$students = [
    [
        'name' => 'Nguyễn Văn An',
        'midterm' => 7.5,
        'final' => 8.0
    ],
    [
        'name' => 'Trần Thị Bình',
        'midterm' => 4.5,
        'final' => 5.0
    ],
    [
        'name' => 'Lê Hoàng Long',
        'midterm' => 6.0,
        'final' => 6.5
    ]
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điểm sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .dat { color: green; font-weight: bold; }
        .chuadat { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Bảng điểm tổng kết học phần</h2>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Điểm giữa kỳ</th>
                <th>Điểm cuối kỳ</th>
                <th>Điểm trung bình</th>
                <th>Kết quả</th>
            </tr>
        </thead>
        <tbody>
            <!-- 3. Dùng foreach để duyệt mảng và in bảng HTML -->
            <?php foreach ($students as $index => $student): ?>
                <?php 
                    // Tính điểm trung bình bằng hàm đã viết
                    $avg = calculateAverage($student['midterm'], $student['final']);
                    
                    // 4. Thêm cột kết quả: Đạt nếu điểm trung bình >= 5, ngược lại là Chưa đạt
                    $result = ($avg >= 5.0) ? "Đạt" : "Chưa đạt";
                    $resultClass = ($avg >= 5.0) ? "dat" : "chuadat";
                ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    
                    <!-- 5. Mã hóa tên sinh viên bằng htmlspecialchars() trước khi in để bảo mật -->
                    <td style="text-align: left;"><?= htmlspecialchars($student['name']) ?></td>
                    
                    <td><?= $student['midterm'] ?></td>
                    <td><?= $student['final'] ?></td>
                    <td><strong><?= number_format($avg, 2) ?></strong></td>
                    <td><span class="<?= $resultClass ?>"><?= $result ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>