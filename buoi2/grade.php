<?php
// Hàm kiểm tra điểm có hợp lệ không (phải là số và trong khoảng từ 0 đến 10)
function isValidScore($score): bool {
    return is_numeric($score) && $score >= 0 && $score <= 10;
}

// Hàm tính điểm tổng kết theo tỷ lệ: 10% chuyên cần, 30% giữa kỳ, 60% cuối kỳ
function finalScore(float $cc, float $mid, float $final): float {
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

// Khởi tạo các biến lưu giá trị để giữ lại dữ liệu khi submit form
$name = $_POST['name'] ?? '';
$cc = $_POST['cc'] ?? '';
$mid = $_POST['mid'] ?? '';
$final = $_POST['final'] ?? '';

$error = '';
$tongket = null;
$xeploai = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra đầu vào
    if (trim($name) === '' || $cc === '' || $mid === '' || $final === '') {
        $error = 'Vui lòng điền đầy đủ tất cả các thông tin!';
    } elseif (!isValidScore($cc) || !isValidScore($mid) || !isValidScore($final)) {
        $error = 'Lỗi: Điểm chuyên cần, giữa kỳ và cuối kỳ phải là số từ 0 đến 10!';
    } else {
        // Tính điểm tổng kết
        $tongket = finalScore((float)$cc, (float)$mid, (float)$final);

        // Xếp loại điểm
        if ($tongket >= 8.0) {
            $xeploai = 'Giỏi';
        } elseif ($tongket >= 6.5) {
            $xeploai = 'Khá';
        } elseif ($tongket >= 5.0) {
            $xeploai = 'Trung bình';
        } else {
            $xeploai = 'Chưa đạt';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy tính điểm học phần</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f7f6; }
        .box { width: 450px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; text-align: center; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; margin-top: 15px; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background: #218838; }
        .error { color: red; margin-top: 15px; font-weight: bold; }
        .result { margin-top: 15px; padding: 10px; background: #e9ecef; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Máy tính điểm học phần</h2>
        
        <!-- Form sử dụng phương thức POST và giữ lại dữ liệu cũ khi submit -->
        <form method="POST" action="">
            <label for="name">Họ và tên sinh viên:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>

            <label for="cc">Điểm Chuyên cần (10%):</label>
            <input type="number" step="0.1" id="cc" name="cc" value="<?= htmlspecialchars($cc) ?>" required>

            <label for="mid">Điểm Giữa kỳ (30%):</label>
            <input type="number" step="0.1" id="mid" name="mid" value="<?= htmlspecialchars($mid) ?>" required>

            <label for="final">Điểm Cuối kỳ (60%):</label>
            <input type="number" step="0.1" id="final" name="final" value="<?= htmlspecialchars($final) ?>" required>

            <button type="submit">Tính điểm tổng kết</button>
        </form>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($tongket !== null && empty($error)): ?>
            <div class="result">
                <p>Họ tên: <b><?= htmlspecialchars($name) ?></b></p>
                <p>Điểm tổng kết: <b style="color: #007bff; font-size: 18px;"><?= number_format($tongket, 2) ?></b></p>
                <p>Xếp loại: <b style="color: green; text-transform: uppercase;"><?= $xeploai ?></b></p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>