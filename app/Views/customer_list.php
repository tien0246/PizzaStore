<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Danh Sách Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
  /* General Page Styles */
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
    color: #16a085; /* Accent color */
  }

  /* Alerts */
  .alert {
    border-radius: 5px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
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

  /* Table Styling */
  .table {
    margin-top: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .table thead th {
    font-weight: bold;
    font-size: 16px;
    text-align: center;
    color: #2c3e50;
    padding: 12px;
    background-color: #16a085; /* Accent color */
    color: white;
  }

  .table tbody td {
    font-size: 14px;
    color: #34495e;
    padding: 10px;
    text-align: center;
  }

  .table tbody tr:hover {
    background-color: #dfe6e9;
    transform: scale(1.01);
    transition: all 0.3s;
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

  .btn-add {
    margin-bottom: 20px;
    background-color: #2ecc71;
    color: white;
    border: none;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .btn-add:hover {
    background-color: #27ae60;
  }

  /* Optional: Add cursor pointer to sortable headers */
  th.sortable {
    cursor: pointer;
  }
  
  /* Optional: Add sort indicator */
  th.sortable:after {
    content: '\25B2\25BC'; /* Up and down arrows */
    font-size: 0.6em;
    margin-left: 5px;
    color: #aaa;
  }

  /* Responsive Design with Bootstrap */
  @media (max-width: 1200px) {
    h2 {
      font-size: 24px;
      padding-bottom: 8px;
    }

    .table thead th,
    .table tbody td {
      font-size: 14px;
      padding: 8px;
    }

    .btn-secondary {
      font-size: 14px;
      padding: 8px 16px;
    }
  }

  @media (max-width: 992px) {
    h2 {
      font-size: 22px;
    }

    .table thead th,
    .table tbody td {
      font-size: 13px;
      padding: 6px;
    }

    .btn-secondary {
      font-size: 13px;
      padding: 6px 12px;
    }
  }

  @media (max-width: 768px) {
    h2 {
      font-size: 20px;
    }

    .table thead th,
    .table tbody td {
      font-size: 12px;
      padding: 6px;
    }

    .btn-secondary {
      font-size: 12px;
      padding: 6px 12px;
    }

    .container {
      padding: 15px;
    }

    .table-responsive {
      margin-top: 20px;
    }
  }

  @media (max-width: 576px) {
    h2 {
      font-size: 18px;
    }

    .table thead th,
    .table tbody td {
      font-size: 11px;
      padding: 5px;
    }

    .btn-secondary {
      font-size: 11px;
      padding: 5px 10px;
    }
  }
</style>

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
            <div class="table-responsive">
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
            </div>
        <?php endif; ?>
        
        <a href="index.php" class="btn btn-secondary">Quay Lại</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
