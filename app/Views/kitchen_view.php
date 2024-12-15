<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Bếp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
    <link rel="stylesheet" href="app/Views/css/kitchen_view.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Món Ăn Cần Làm</h2>
        
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
        
        <?php if (empty($dishes)): ?>
            <div class="alert alert-info" role="alert">
                Không có món ăn nào cần làm tại thời điểm này.
            </div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Món</th>
                        <th>Tên Món</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Mã Nhân Viên Bếp</th>
                        <th>Mã Nhân Viên Phục Vụ</th>
                        <th>Thời Gian Nhận</th>
                        <th>Thời Gian Hoàn Tất</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dishes as $dish): ?>
                        <tr>
                            <td><?= htmlspecialchars($dish['MaMon']) ?></td>
                            <td><?= htmlspecialchars($dish['TenMon']) ?></td>
                            <td><?= htmlspecialchars($dish['MaDH']) ?></td>
                            <td><?= htmlspecialchars($dish['MaNVBep']) ?></td>
                            <td><?= htmlspecialchars($dish['MaNVPhucVu']) ?></td>
                            <td><?= htmlspecialchars($dish['ThoiGianNhan']) ?></td>
                            <td><?= htmlspecialchars($dish['ThoiGianHoanTat']) ?></td>
                            <td>
                                <?php if ($dish['Status'] === 'Hoàn thành'): ?>
                                    <?= htmlspecialchars($dish['Status']) ?>
                                <?php else: ?>
                                    <form method="post" action="index.php?controller=kitchen&action=updateStatus" style="display:inline;">
                                        <input type="hidden" name="MaMon" value="<?= htmlspecialchars($dish['MaMon']) ?>">
                                        <input type="hidden" name="MaDH" value="<?= htmlspecialchars($dish['MaDH']) ?>">
                                        <button type="submit">Hoàn tất món</button>
                                    </form>
                                <?php endif; ?> 
                            </td>
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
