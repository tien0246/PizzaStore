<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
    <script>
        function addMonAn() {
            const container = document.getElementById('monAnContainer');
            const index = container.children.length;
            const monAnOptions = `<?php foreach ($monAn as $mon): ?>
                <option value="<?= htmlspecialchars($mon['MaMon']) ?>"><?= htmlspecialchars($mon['TenMon']) ?></option>
            <?php endforeach; ?>`;
            const html = `
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select class="form-select" name="monAn[]" required>
                            <option value="">Chọn Món</option>
                            ${monAnOptions}
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="soLuong[]" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="gia[]" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="ghiChu[]" placeholder="Ghi chú">
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tạo Đơn Hàng Mới</h2>
        
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
        
        <form method="POST" action="index.php?controller=order&action=store">
            <div class="mb-3">
                <label class="form-label">Loại Đơn Hàng</label>
                <select class="form-select" name="loaiDH" required>
                    <option value="Dat truoc">Đặt trước</option>
                    <option value="Khong dat truoc">Không đặt trước</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Khách Hàng</label>
                <select class="form-select" name="maKH">
                    <option value="">Không chọn</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?= htmlspecialchars($customer['MaKH']) ?>"><?= htmlspecialchars($customer['HoTen']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="thoiGianHenGiao" class="form-label">Thời Gian Hẹn Giao</label>
                <input type="datetime-local" class="form-control" id="thoiGianHenGiao" name="thoiGianHenGiao">
            </div>
            <div class="mb-3">
                <label for="thoiGianDatBan" class="form-label">Thời Gian Đặt Bàn</label>
                <input type="datetime-local" class="form-control" id="thoiGianDatBan" name="thoiGianDatBan">
            </div>
            <h4 class="mt-4">Món Ăn</h4>
            <div id="monAnContainer">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select class="form-select" name="monAn[]" required>
                            <option value="">Chọn Món</option>
                            <?php foreach ($monAn as $mon): ?>
                                <option value="<?= htmlspecialchars($mon['MaMon']) ?>"><?= htmlspecialchars($mon['TenMon']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="soLuong[]" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="gia[]" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="ghiChu[]" placeholder="Ghi chú">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mb-3" onclick="addMonAn()">Thêm Món</button>
            <br>
            <button type="submit" class="btn btn-primary">Tạo Đơn Hàng</button>
            <a href="index.php" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
