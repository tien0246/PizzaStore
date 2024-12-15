<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
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

  /* Responsive Design */
  @media (max-width: 768px) {
    h2 {
      font-size: 20px;
      padding-bottom: 8px;
    }

    .table thead th,
    .table tbody td {
      font-size: 12px;
      padding: 8px;
    }

    .btn-secondary,
    .btn-primary,
    .btn-add {
      font-size: 14px;
      padding: 8px 16px;
    }
  }
</style>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Nhân Viên</h2>

        <!-- Add Employee Button -->
        <!-- <a href="index.php?controller=employee&action=create" class="btn btn-add">Thêm Nhân Viên</a> -->
        
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
        
        <!-- Employee Table -->
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
                        <!-- <th>Hành Động</th> -->
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
            <!-- <td>
                <a href="index.php?controller=employee&action=edit&id=<?= htmlspecialchars($employee['MaNV']) ?>" class="btn btn-primary btn-sm">Sửa</a>
            </td> -->
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
