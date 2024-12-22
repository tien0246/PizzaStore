<?php
// Ensure that the session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assuming $employee contains the employee data passed from the controller
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Sửa Thông Tin Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
    /* You can reuse the same CSS styles from your employee_list.php or customize as needed */
    /* General Page Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(
            rgba(50, 50, 50, 0.5),
            rgba(50, 50, 50, 0.5)
        ),
        url("https://t3.ftcdn.net/jpg/05/64/32/70/360_F_564327039_eHOuKCz4S0BZbVbLrdnIj4cSlZimBIe7.jpg")
            fixed;
        background-size: cover;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Container Styling */
    .container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    /* Page Title */
    h2 {
        color: #2c3e50;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #bdc3c7;
        padding-bottom: 10px;
    }

    /* Alerts */
    .alert {
        border-radius: 5px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    /* Buttons */
    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        color: #ffffff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-secondary {
        background-color: #95a5a6;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        color: #ffffff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        h2 {
            font-size: 20px;
            padding-bottom: 8px;
        }

        .form-control {
            font-size: 14px;
            padding: 8px;
        }

        .btn-primary,
        .btn-secondary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
</style>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sửa Thông Tin Nhân Viên</h2>

        <!-- Success and Error Alerts -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Edit Employee Form -->
        <form action="index.php?controller=employee&action=update&id=<?= htmlspecialchars($employee['MaNV']) ?>" method="POST">
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?= htmlspecialchars($employee['HoTen']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?= htmlspecialchars($employee['NgaySinh']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" value="<?= htmlspecialchars($employee['CanCuocCongDan']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giới Tính</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNam" value="M" <?= ($employee['GioiTinh'] === 'M') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gioiTinhNam">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gioiTinh" id="gioiTinhNu" value="F" <?= ($employee['GioiTinh'] === 'F') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gioiTinhNu">Nữ</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" value="<?= htmlspecialchars($employee['SoDienThoai']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="soNha" class="form-label">Số Nhà</label>
                <input type="text" class="form-control" id="soNha" name="soNha" value="<?= htmlspecialchars($employee['SoNha']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="duong" class="form-label">Đường</label>
                <input type="text" class="form-control" id="duong" name="duong" value="<?= htmlspecialchars($employee['Duong']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="xa" class="form-label">Xã</label>
                <input type="text" class="form-control" id="xa" name="xa" value="<?= htmlspecialchars($employee['Xa']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="huyen" class="form-label">Huyện</label>
                <input type="text" class="form-control" id="huyen" name="huyen" value="<?= htmlspecialchars($employee['Huyen']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="tinh" class="form-label">Tỉnh</label>
                <input type="text" class="form-control" id="tinh" name="tinh" value="<?= htmlspecialchars($employee['Tinh']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="maPB" class="form-label">Phòng Ban</label>
                <input type="text" class="form-control" id="maPB" name="maPB" value="<?= htmlspecialchars($employee['MaPB']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php?controller=employee&action=update" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
