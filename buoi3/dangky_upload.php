<?php
// Khai báo biến lưu dữ liệu và thông báo lỗi
$username = '';
$email = '';
$errors = [];
$success = '';

// Luồng xử lý form chuẩn: Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Đọc dữ liệu và làm sạch (Sanitization)
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Validate dữ liệu phía Server (PHP)
    if (empty($username)) {
        $errors['username'] = 'Tên đăng nhập không được để trống!';
    } elseif (strlen($username) < 3) {
        $errors['username'] = 'Tên đăng nhập phải từ 3 ký tự trở lên!';
    }

    if (empty($email)) {
        $errors['email'] = 'Email không được để trống!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Định dạng email không hợp lệ!';
    }

    if (empty($password)) {
        $errors['password'] = 'Mật khẩu không được để trống!';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự!';
    }

    // 3. Kiểm tra và xử lý Upload file ảnh đại diện an toàn (Theo yêu cầu slide 3.6)
    $avatarPath = '';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileSize = $_FILES['avatar']['size'];

            // Kiểm tra 1: Giới hạn kích thước tối đa (Ví dụ: tối đa 2MB)
            $maxSize = 2 * 1024 * 1024; 
            if ($fileSize > $maxSize) {
                $errors['avatar'] = 'Kích thước ảnh quá lớn (Tối đa 2MB)!';
            } else {
                // Kiểm tra 2: Kiểm tra phần mở rộng và MIME type thực tế[cite: 8]
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $checkImage = getimagesize($fileTmpPath);

                if (!in_array($fileExtension, $allowedExtensions) || $checkImage === false) {
                    $errors['avatar'] = 'Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG!';
                } else {
                    // Kiểm tra 3: Đổi tên file mới an toàn để tránh ghi đè và ký tự nguy hiểm[cite: 8]
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = './uploads/';
                    
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0755, true);
                    }
                    
                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $avatarPath = $dest_path;
                    } else {
                        $errors['avatar'] = 'Không thể lưu file ảnh lên server.';
                    }
                }
            }
        } else {
            $errors['avatar'] = 'Lỗi trong quá trình tải file lên!';
        }
    } else {
        $errors['avatar'] = 'Vui lòng chọn ảnh đại diện!';
    }

    // 4. Nếu không có lỗi (Validation thành công) -> Lưu DB / Xử lý kết quả
    if (empty($errors)) {
        $success = "Đăng ký thành công tài khoản: " . htmlspecialchars($username);
        // Reset dữ liệu form nếu muốn
        $username = '';
        $email = '';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thực hành Buổi 3 - Form & Upload An Toàn</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"], input[type="file"] {
            width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
        }
        .error { color: #d9534f; font-size: 13px; margin-top: 4px; }
        .success { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; }
        button { background: #28a745; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background: #218838; }
        .preview { margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng Ký & Upload Ảnh Đại Diện</h2>

    <!-- Hiển thị thông báo thành công -->
    <?php if ($success): ?>
        <div class="success">
            <?= $success ?><br>
            <?php if ($avatarPath): ?>
                <div class="preview">Ảnh đại diện:<br><img src="<?= $avatarPath ?>" width="100" alt="Avatar"></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Form truyền dữ liệu kèm enctype để upload file -->
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Tên đăng nhập -->
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <!-- Áp dụng Sticky Form và chống XSS bằng htmlspecialchars -->
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

        <!-- Upload ảnh đại diện -->
        <div class="form-group">
            <label for="avatar">Ảnh đại diện (JPG, PNG - Max 2MB):</label>
            <input type="file" id="avatar" name="avatar">
            <?php if (isset($errors['avatar'])): ?>
                <div class="error"><?= $errors['avatar'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Hoàn tất đăng ký</button>
    </form>
</div>

</body>
</html>