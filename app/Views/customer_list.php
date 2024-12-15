    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Danh Sách Khách Hàng</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="app/Views/css/style.css">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Danh Sách Khách Hàng</h2>
            
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
            
            <?php if (empty($customers)): ?>
                <div class="alert alert-info" role="alert">
                    Không có khách hàng nào trong hệ thống.
                </div>
            <?php else: ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Mã KH</th>
                            <th>Họ Tên</th>
                            <th>Giới Tính</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Loại KH</th>
                            <th>Ngày Sinh</th>
                            <th>CCCD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= htmlspecialchars($customer['MaKH']) ?></td>
                                <td><?= htmlspecialchars($customer['HoTen']) ?></td>
                                <td><?= ($customer['GioiTinh'] === 'M') ? 'Nam' : 'Nữ' ?></td>
                                <td><?= htmlspecialchars($customer['SoDienThoai']) ?></td>
                                <td>
                                    <?= htmlspecialchars($customer['SoNha']) . ', ' . htmlspecialchars($customer['TenDuong']) . ', ' . htmlspecialchars($customer['PhuongXa']) . ', ' . htmlspecialchars($customer['QuanHuyen']) . ', ' . htmlspecialchars($customer['TinhThanh']) ?>
                                </td>
                                <td><?= htmlspecialchars($customer['LoaiKH']) ?></td>
                                <td><?= htmlspecialchars($customer['NgaySinh']) ?></td>
                                <td><?= htmlspecialchars($customer['CCCD']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <a href="index.php" class="btn btn-secondary">Quay Lại</a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
