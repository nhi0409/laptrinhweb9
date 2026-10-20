<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài tập Mảng sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { padding: 20px; border: 1px solid #ccc; background: #f9f9f9; border-radius: 5px; width: 450px; }
        .student-item { margin-bottom: 10px; padding: 8px; background: #fff; border-left: 4px solid #007bff; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Danh sách sinh viên và điểm số</h2>

        <?php
        // Tạo mảng chứa 3 sinh viên, mỗi sinh viên là một mảng kết hợp gồm name và score[cite: 13]
        $students = [
            ['name' => 'An', 'score' => 8.0],
            ['name' => 'Bình', 'score' => 6.5],
            ['name' => 'Chi', 'score' => 4.5]
        ];

        // Sử dụng vòng lặp foreach để duyệt từng bản ghi sinh viên[cite: 13]
        foreach ($students as $student) {
            echo "<div class='student-item'>";
            echo "Tên: <b>" . $student['name'] . "</b>";
            echo " - Điểm: <span style='color: green; font-weight: bold;'>" . $student['score'] . "</span>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>