
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài tập tính điểm tổng kết bằng Hàm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { padding: 20px; border: 1px solid #ccc; background: #f9f9f9; border-radius: 5px; width: 450px; }
        input[type="text"] { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { padding: 10px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result { margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Tính điểm tổng kết môn học</h2>
        
        <!-- Form nhập điểm chuyên cần, giữa kỳ, cuối kỳ -->
        <form method="GET" action="">
            <label for="cc">Điểm Chuyên cần (10%):</label>
            <input type="text" id="cc" name="cc" required>

            <label for="mid">Điểm Giữa kỳ (30%):</label>
            <input type="text" id="mid" name="mid" required>

            <label for="final">Điểm Cuối kỳ (60%):</label>
            <input type="text" id="final" name="final" required>

            <button type="submit">Tính điểm tổng kết</button>
        </form>

        <div class="result">
            <?php
            // Định nghĩa hàm tính điểm tổng kết theo yêu cầu bài học[cite: 12]
            function finalScore(float $cc, float $mid, float $final): float
            {
                return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
            }

            // Kiểm tra khi người dùng gửi dữ liệu lên qua phương thức GET
            if (isset($_GET['cc']) && isset($_GET['mid']) && isset($_GET['final'])) {
                $cc = $_GET['cc'];
                $mid = $_GET['mid'];
                $final = $_GET['final'];

                // Kiểm tra dữ liệu đầu vào có phải là số không
                if (is_numeric($cc) && is_numeric($mid) && is_numeric($final)) {
                    // Gọi hàm tính điểm tổng kết
                    $tongket = finalScore((float)$cc, (float)$mid, (float)$final);
                    echo "<p style='color: green;'>Điểm tổng kết: <span style='font-size: 18px;'>" . number_format($tongket, 2) . "</span></p>";
                } else {
                    echo "<p style='color: red;'>Lỗi: Vui lòng nhập các giá trị số hợp lệ!</p>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>