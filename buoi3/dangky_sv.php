<?php
$errors = [];
$data = ['name' => '', 'email' => '', 'birthday' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // Kiểm tra dữ liệu bắt buộc và hợp lệ theo slide 3.7
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }
    if ($data['birthday'] === '') {
        $errors['birthday'] = 'Vui lòng nhập ngày sinh';
    }

    // Nếu không có lỗi, thực hiện chuyển hướng trang (redirect)
    if (!$errors) {
        header('Location: success.php');
        exit;
    }
}

// Hàm mã hóa đầu ra chống XSS
function e($v) { 
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); 
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Đăng Ký Sinh Viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        .container { max-width: 450px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"] {
            width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
        }
        .error { color: #d9534f; font-size: 13px; margin-top: 4px; }
        button { background: #007bff; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng Ký Sinh Viên</h2>
    
    <form action="" method="POST">
        <!-- Họ tên -->
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="name" value="<?= e($data['name']) ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" value="<?= e($data['email']) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <!-- Ngày sinh -->
        <div class="form-group">
            <label>Ngày sinh:</label>
            <input type="date" name="birthday" value="<?= e($data['birthday']) ?>">
            <?php if (isset($errors['birthday'])): ?>
                <div class="error"><?= $errors['birthday'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Đăng ký</button>
    </form>
</div>

</body>
</html>