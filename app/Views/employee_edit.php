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
    <title>Sửa Thông Tin Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
    /* You can reuse the same CSS styles from your employee_list.php or customize as needed */
    /* ... (Include your existing styles here) ... */
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
