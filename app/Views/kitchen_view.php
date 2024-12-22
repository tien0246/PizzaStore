<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Quản Lý Bếp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(
            rgba(83, 244, 241, 0.2),
            rgba(22, 209, 122, 0.3)
          ) fixed;
        background-size: cover;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: auto;
    }

    h2 {
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 28px;
        border-bottom: 2px solid #bdc3c7;
        padding-bottom: 10px;
        color: #16a085; /* Accent color */
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }

    table {
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table thead th {
        font-weight: 700;
        font-size: 16px;
        background-color: #16a085; /* Accent color */
        color: white;
    }

    table tbody td {
        font-size: 14px;
        color: #34495e;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 14px;
        color: #ffffff;
    }

    .badge-status.pending {
        background-color: #f39c12;
    }

    .badge-status.in-progress {
        background-color: #2980b9;
    }

    .badge-status.completed {
        background-color: #27ae60;
    }

    .badge-status.cancelled {
        background-color: #c0392b;
    }

    table tbody tr:hover {
        background-color: #ecf0f1;
    }
    table thead tr th {
      color:rgb(5, 58, 117);
      align-items: center;
      text-align: center;
    }
    table tbody tr td {
      align-items: center;
      text-align: center;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: #ffffff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
        color: #ffffff;
    }

    .btn-primary {
        background-color: #2980b9;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1d6fa5;
    }
    .btn-secondary {
        background-color:rgb(39, 59, 72);
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 24px;
        }

        table thead th,
        table tbody td {
            font-size: 12px;
            padding: 8px;
        }

        .btn {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
</style>
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
                        <th>Trạng thái</th>
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
                            <td>
                                <?php if ($dish['Status'] === 'Hoàn thành'): ?>
                                    <span class="badge-status completed"><?= htmlspecialchars($dish['Status']) ?></span>
                                <?php else: ?>
                                    <form method="post" action="index.php?controller=kitchen&action=updateStatus" style="display:inline;">
                                        <input type="hidden" name="MaMon" value="<?= htmlspecialchars($dish['MaMon']) ?>">
                                        <input type="hidden" name="MaDH" value="<?= htmlspecialchars($dish['MaDH']) ?>">
                                        <button class="btn-primary" type="submit">Hoàn tất món</button>
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
