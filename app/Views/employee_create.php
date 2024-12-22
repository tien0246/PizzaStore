<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Nhân Viên</h2>
        <form method="POST" action="index.php?controller=employee&action=store">
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" placeholder="Nhập họ tên" required>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" required>
            </div>
            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" placeholder="Nhập CCCD" required>
            </div>
            <div class="mb-3">
                <label for="gioiTinh" class="form-label">Giới Tính</label>
                <select class="form-select" id="gioiTinh" name="gioiTinh" required>
                    <option value="M">Nam</option>
                    <option value="F">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" placeholder="Nhập số điện thoại" required>
            </div>
            <!-- Address Fields -->
            <div class="mb-3">
                <label for="soNha" class="form-label">Số Nhà</label>
                <input type="text" class="form-control" id="soNha" name="soNha" placeholder="Nhập số nhà" required>
            </div>
            <div class="mb-3">
                <label for="duong" class="form-label">Đường</label>
                <input type="text" class="form-control" id="duong" name="duong" placeholder="Nhập tên đường" required>
            </div>
            <div class="mb-3">
                <label for="xa" class="form-label">Xã</label>
                <input type="text" class="form-control" id="xa" name="xa" placeholder="Nhập tên xã" required>
            </div>
            <div class="mb-3">
                <label for="huyen" class="form-label">Huyện</label>
                <input type="text" class="form-control" id="huyen" name="huyen" placeholder="Nhập tên huyện" required>
            </div>
            <div class="mb-3">
                <label for="tinh" class="form-label">Tỉnh</label>
                <input type="text" class="form-control" id="tinh" name="tinh" placeholder="Nhập tên tỉnh" required>
            </div>
            <div class="mb-3">
                <label for="maPB" class="form-label">Phòng Ban</label>
                <input type="text" class="form-control" id="maPB" name="maPB" placeholder="Nhập mã phòng ban" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
