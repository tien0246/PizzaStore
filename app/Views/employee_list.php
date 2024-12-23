<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Danh Sách Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
  /* General Page Styles */
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(
        rgba(83, 244, 241, 0.3), /* Adjusted background gradient for harmony */
        rgba(22, 209, 122, 0.5)
      ),
      url("https://t3.ftcdn.net/jpg/05/64/32/70/360_F_564327039_eHOuKCz4S0BZbVbLrdnIj4cSlZimBIe7.jpg")
        no-repeat center center fixed; /* Ensuring the background image doesn't repeat */
    background-size: cover; /* Ensures the background covers the entire screen */
    color: #333;
    margin: 0;
    padding: 0;
  }

  /* Container Styling */
  .container {
    background-color: rgba(255, 255, 255, 0.95); /* Slight transparency to show background */
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
    color: #16a085; /* Accent color for consistency */
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

    .table-responsive {
      margin-top: 20px;
    }
  }
</style>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Nhân Viên</h2>

        <!-- Add Employee Button -->
        <a href="index.php?controller=employee&action=create" class="btn btn-add">Thêm Nhân Viên</a>
        
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
        
        <!-- Search Form -->
        <form class="row g-3 mb-4" method="GET" action="index.php">
            <input type="hidden" name="controller" value="employee">
            <input type="hidden" name="action" value="list">
            <div class="col-md-4 col-12">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm nhân viên..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            </div>
            <div class="col-md-2 col-12">
                <button type="submit" class="btn btn-primary px-3 py-2">Tìm Kiếm</button>
            </div>
        </form>
        
        <!-- Employee Table -->
        <?php if (empty($employees)): ?>
            <div class="alert alert-info" role="alert">
                Không có nhân viên nào trong hệ thống.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <?php
                                // Function to generate sort URLs
                                function sortUrl($column, $currentSort, $currentOrder, $search) {
                                    $order = 'ASC';
                                    if ($currentSort === $column && $currentOrder === 'ASC') {
                                        $order = 'DESC';
                                    }
                                    $params = [
                                        'controller' => 'employee',
                                        'action' => 'list',
                                        'sort' => $column,
                                        'order' => $order,
                                    ];
                                    if (!empty($search)) {
                                        $params['search'] = $search;
                                    }
                                    return 'index.php?' . http_build_query($params);
                                }

                                // Get current sort and order
                                $currentSort = isset($_GET['sort']) ? $_GET['sort'] : 'MaNV';
                                $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                            ?>
                            <th class="sortable"><a href="<?= sortUrl('MaNV', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Mã NV</a></th>
                            <th class="sortable"><a href="<?= sortUrl('HoTen', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Họ Tên</a></th>
                            <th class="sortable"><a href="<?= sortUrl('NgaySinh', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Ngày Sinh</a></th>
                            <th class="sortable"><a href="<?= sortUrl('CanCuocCongDan', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">CCCD</a></th>
                            <th class="sortable"><a href="<?= sortUrl('GioiTinh', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Giới Tính</a></th>
                            <th class="sortable"><a href="<?= sortUrl('SoDienThoai', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Số Điện Thoại</a></th>
                            <th class="sortable"><a href="<?= sortUrl('SoNha', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Địa Chỉ</a></th>
                            <th class="sortable"><a href="<?= sortUrl('MaPB', $currentSort, $currentOrder, $search) ?>" class="text-decoration-none text-dark">Phòng Ban</a></th>
                            <th>Sửa</th>
                            <th>Xóa</th>
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
                                <!-- Sửa (Edit) Button -->
                                <td>
                                    <a href="index.php?controller=employee&action=edit&id=<?= htmlspecialchars($employee['MaNV']) ?>" class="btn btn-primary">Sửa</a>
                                </td>
                                <!-- Xóa (Delete) Button -->
                                <td>
                                    <form action="index.php?controller=employee&action=delete&id=<?= htmlspecialchars($employee['MaNV'])?>" method="POST">
                                        <input type="hidden">
                                        <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">Xóa</button>
                                    </form>
                                </td>
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
