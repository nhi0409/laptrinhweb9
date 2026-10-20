<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kiểm tra điểm hợp lệ</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .result { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Bài tập thực hành: Kiểm tra điểm hợp lệ (0 - 10)</h2>

    <!-- Form nhập điểm sử dụng phương thức GET -->
    <form method="GET" action="">
        <label for="diem">Nhập số điểm cần kiểm tra:</label>
        <input type="text" id="diem" name="diem" required>
        <button type="submit">Kiểm tra</button>
    </form>

    <div class="result">
        <?php
        // Kiểm tra xem người dùng đã bấm nút gửi dữ liệu (GET) lên chưa
        if (isset($_GET['diem'])) {
            $diem = $_GET['diem'];

            // Kiểm tra điều kiện: Phải là số (is_numeric) VÀ nằm trong khoảng từ 0 đến 10[cite: 3]
            if (is_numeric($diem) && $diem >= 0 && $diem <= 10) {
                echo "<p style='color: green;'>Điểm hợp lệ: $diem</p>";
            } else {
                echo "<p style='color: red;'>Điểm không hợp lệ! Vui lòng nhập số từ 0 đến 10.</p>";
            }
        }
        ?>
    </div>

</body>
</html>