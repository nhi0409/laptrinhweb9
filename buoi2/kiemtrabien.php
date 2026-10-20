<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Biến và kiểu dữ liệu trong PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { padding: 15px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>Bài tập: Biến và kiểu dữ liệu trong PHP[cite: 9]</h2>

    <div class="box">
        <?php
        $x = "5"; // Kiểu string[cite: 9]
        $y = 5;   // Kiểu int[cite: 9]

        // Sử dụng hàm gettype() để kiểm tra kiểu dữ liệu thực tế của biến
        echo "Kiểu dữ liệu của <code>\$x</code> là: <b>" . gettype($x) . "</b><br>";
        echo "Kiểu dữ liệu của <code>\$y</code> là: <b>" . gettype($y) . "</b><br>";

        // Thực hiện phép cộng
        $ket_qua = $x + $y;
        echo "<hr>";
        echo "Kết quả của biểu thức <code>\$x + \$y</code> là: <b style='color: green; font-size: 18px;'>$ket_qua</b>[cite: 9]";
        ?>
    </div>

</body>
</html>