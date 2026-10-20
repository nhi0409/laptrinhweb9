<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tính tiền tài liệu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { padding: 20px; border: 1px solid #ccc; background: #f9f9f9; border-radius: 5px; width: 500px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result { margin-top: 15px; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Tính tiền tài liệu</h2>
        
        <!-- Form nhập dữ liệu sử dụng phương thức POST -->
        <form method="POST" action="">
            <label for="ten_tai_lieu">Tên tài liệu:</label>
            <input type="text" id="ten_tai_lieu" name="ten_tai_lieu" required>

            <label for="so_luong">Số lượng:</label>
            <input type="number" id="so_luong" name="so_luong" min="1" required>

            <label for="don_gia">Đơn giá (đ):</label>
            <input type="number" id="don_gia" name="don_gia" min="0" step="1000" required>

            <button type="submit" name="tinh">Tính</button>
        </form>

        <div class="result">
            <?php
            // Kiểm tra xem người dùng đã nhấn nút "Tính" hay chưa
            if (isset($_POST['tinh'])) {
                $ten_tai_lieu = trim($_POST['ten_tai_lieu']);
                $so_luong = $_POST['so_luong'];
                $don_gia = $_POST['don_gia'];

                // Kiểm tra dữ liệu số lượng và đơn giá có hợp lệ không
                if (is_numeric($so_luong) && is_numeric($don_gia) && $so_luong > 0 && $don_gia >= 0) {
                    $so_tien = $so_luong * $don_gia;
                    
                    // Hiển thị kết quả giống với định dạng mẫu trong đề bài
                    echo "<p style='color: green;'>" . htmlspecialchars($ten_tai_lieu) . ": " . number_format($so_tien, 0, ',', '.') . " đ</p>";
                } else {
                    echo "<p style='color: red;'>Lỗi: Vui lòng nhập số lượng và đơn giá hợp lệ!</p>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>