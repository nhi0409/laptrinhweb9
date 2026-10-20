<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài tập xếp loại điểm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { padding: 20px; border: 1px solid #ccc; background: #f9f9f9; border-radius: 5px; width: 400px; }
        input[type="text"] { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { padding: 10px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result { margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Chương trình Xếp loại điểm</h2>
        
        <!-- Form nhập điểm sử dụng phương thức GET -->
        <form method="GET" action="">
            <label for="diem">Nhập số điểm (từ 0 đến 10):</label>
            <input type="text" id="diem" name="diem" required>
            <button type="submit">Kiểm tra xếp loại</button>
        </form>

        <div class="result">
            <?php
            // Kiểm tra xem người dùng đã bấm nút gửi dữ liệu chưa
            if (isset($_GET['diem'])) {
                $diem = $_GET['diem'];

                // Kiểm tra dữ liệu đầu vào có hợp lệ là số từ 0 đến 10 không
                if (is_numeric($diem) && $diem >= 0 && $diem <= 10) {
                    
                    // Sử dụng cấu trúc if/elseif/else theo thứ tự từ cao xuống thấp
                    if ($diem >= 8.0) {
                        echo "<p style='color: green;'>Điểm $diem: Xếp loại <b>Giỏi</b></p>";
                    } elseif ($diem >= 6.5) {
                        echo "<p style='color: blue;'>Điểm $diem: Xếp loại <b>Khá</b></p>";
                    } elseif ($diem >= 5.0) {
                        echo "<p style='color: orange;'>Điểm $diem: Xếp loại <b>Trung bình</b></p>";
                    } else {
                        echo "<p style='color: red;'>Điểm $diem: Xếp loại <b>Chưa đạt</b></p>";
                    }

                } else {
                    echo "<p style='color: red;'>Lỗi: Vui lòng nhập số hợp lệ từ 0 đến 10!</p>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>