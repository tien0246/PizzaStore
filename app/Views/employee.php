<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Nhân Viên</h2>
        
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
        
        <?php if (empty($employees)): ?>
            <div class="alert alert-info" role="alert">
                Không có nhân viên nào trong hệ thống.
            </div>
        <?php else: ?>
            <table class="table table-bordered table-hover">
                <thead class="table-warning">
                    <tr>
                        <th>Mã NV</th>
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>CCCD</th>
                        <th>Giới Tính</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Phòng Ban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= htmlspecialchars($employee['MaNV']) ?></td>
                            <td><?= htmlspecialchars($employee['HoTen']) ?></td>
                            <td><?= htmlspecialchars($employee['NgaySinh']) ?></td>
                            <td><?= htmlspecialchars($employee['CanCuocCongDan']) ?></td>
                            <td><?= ($employee['GioiTinh'] === 'M') ? 'Nam' : 'Nữ' ?></td>
                            <td><?= htmlspecialchars($employee['SoDienThoai']) ?></td>
                            <td>
                                <?= htmlspecialchars($employee['SoNha']) . ', ' . htmlspecialchars($employee['Duong']) . ', ' . htmlspecialchars($employee['Xa']) . ', ' . htmlspecialchars($employee['Huyen']) . ', ' . htmlspecialchars($employee['Tinh']) ?>
                            </td>
                            <td><?= htmlspecialchars($employee['MaPB']) ?></td>
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
