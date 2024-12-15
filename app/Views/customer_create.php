<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tạo Khách Hàng Mới</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form method="POST" action="index.php?controller=customer&action=store">
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới Tính</label>
                <select class="form-select" name="gioiTinh" required>
                    <option value="M">Nam</option>
                    <option value="F">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" required>
            </div>
            <div class="mb-3">
                <label for="soNha" class="form-label">Số Nhà</label>
                <input type="text" class="form-control" id="soNha" name="soNha" required>
            </div>
            <div class="mb-3">
                <label for="tenDuong" class="form-label">Tên Đường</label>
                <input type="text" class="form-control" id="tenDuong" name="tenDuong" required>
            </div>
            <div class="mb-3">
                <label for="phuongXa" class="form-label">Phường/Xã</label>
                <input type="text" class="form-control" id="phuongXa" name="phuongXa" required>
            </div>
            <div class="mb-3">
                <label for="quanHuyen" class="form-label">Quận/Huyện</label>
                <input type="text" class="form-control" id="quanHuyen" name="quanHuyen" required>
            </div>
            <div class="mb-3">
                <label for="tinhThanh" class="form-label">Tỉnh/Thành</label>
                <input type="text" class="form-control" id="tinhThanh" name="tinhThanh" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Loại Khách Hàng</label>
                <select class="form-select" name="loaiKH" required>
                    <option value="Ca nhan">Cá nhân</option>
                    <option value="Ung dung">Ứng dụng</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh">
            </div>
            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo Khách Hàng</button>
            <a href="index.php" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
