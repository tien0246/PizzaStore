<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Hệ Thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
    <link rel="stylesheet" href="app/Views/css/menu.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1 class="mb-4">Hệ Thống Quản Lý</h1>
        
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
        
        <div class="row justify-content-center">
<!--             
            <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=order&action=create'">
                    <div class="card-body">
                        <h5 class="card-title">Tạo Đơn Hàng</h5>
                        <p class="card-text">Tạo mới một đơn hàng với các món ăn.</p>
                    </div>
                </div>
            </div> -->
            <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=kitchen&action=view'">
                    <div class="card-body">
                        <h5 class="card-title">Bếp</h5>
                        <p class="card-text">Quản lý các món ăn đang chế biến.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=report&action=view'">
                    <div class="card-body">
                        <h5 class="card-title">Báo cáo</h5>
                        <p class="card-text">Thống kê đơn hàng, món ăn và doanh thu</p>
                    </div>
                </div>
            </div> -->
            <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=customer&action=list'">
                    <div class="card-body">
                        <h5 class="card-title">Danh Sách Khách Hàng</h5>
                        <p class="card-text">Xem và quản lý danh sách khách hàng.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=employee&action=list'">
                    <div class="card-body">
                        <h5 class="card-title">Danh Sách Nhân viên</h5>
                        <p class="card-text">Xem và quản lý danh sách nhân viên.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="card menu-card" onclick="window.location.href='index.php?controller=customer&action=create'">
                    <div class="card-body">
                        <h5 class="card-title">Tạo Khách Hàng</h5>
                        <p class="card-text">Nhập thông tin khách hàng mới.</p>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
