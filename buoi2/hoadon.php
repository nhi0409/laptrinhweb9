<?php
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' đ';
}
$name = $_POST['name'] ?? '';
$qty = (int)($_POST['qty'] ?? 0);
$price = (float)($_POST['price'] ?? 0);
$total = $qty * $price;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Demo Hóa đơn học liệu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { margin-bottom: 20px; }
        input { display: block; margin: 10px 0; padding: 8px; width: 300px; box-sizing: border-box; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

    <form method="post">
        <input name="name" placeholder="Tên tài liệu" required>
        <input name="qty" type="number" min="1" placeholder="Số lượng" required>
        <input name="price" type="number" min="0" placeholder="Đơn giá" required>
        <button>Tính</button>
    </form>

    <?php if ($total > 0): ?>
        <p style="font-size: 18px; font-weight: bold; color: green;">
            <?= htmlspecialchars($name) ?>: <?= money($total) ?>
        </p>
    <?php endif; ?>

</body>
</html>