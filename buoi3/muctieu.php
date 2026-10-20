<?php
// Khai báo các biến lưu dữ liệu cũ và thông báo lỗi
$username = '';
$email = '';
$errors = [];
$success = '';

// Kiểm tra xem form đã được gửi bằng phương thức POST chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Lấy dữ liệu và làm sạch sơ bộ (Sanitization - Loại bỏ khoảng trắng thừa)
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Kiểm tra dữ liệu (Validation phía Server - PHP)
    
    // Kiểm tra Tên người dùng
    if (empty($username)) {
        $errors['username'] = 'Tên đăng nhập không được để trống!';
    } elseif (strlen($username) < 3) {
        $errors['username'] = 'Tên đăng nhập phải có ít nhất 3 ký tự!';
    }

    // Kiểm tra Email
    if (empty($email)) {
        $errors['email'] = 'Email không được để trống!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Định dạng email không hợp lệ!';
    }

    // Kiểm tra Mật khẩu
    if (empty($password)) {
        $errors['password'] = 'Mật khẩu không được để trống!';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Mật khẩu phải từ 6 ký tự trở lên!';
    }

    // 3. Nếu không có lỗi thì xử lý thành công
    if (empty($errors)) {
        // htmlspecialchars giúp phòng chống XSS khi hiển thị dữ liệu ra màn hình
        $success = "Đăng ký thành công tài khoản: " . htmlspecialchars($username);
        // Reset lại dữ liệu sau khi đăng ký thành công
        $username = '';
        $email = '';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3 - Form Validation & Bảo Mật Dữ Liệu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 40px;
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-radius;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }
        .error {
            color: #d9534f;
            font-size: 13px;
            margin-top: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 11px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Thực Hành Buổi 3</h2>

    <!-- Thông báo thành công -->
    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <!-- Tên đăng nhập -->
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <!-- Sticky Form + Phòng chống XSS bằng htmlspecialchars -->
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="error"><?= $errors['username'] ?></div>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <!-- Mật khẩu -->
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password">
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Đăng ký tài khoản</button>
    </form>
</div>

</body>
</html>