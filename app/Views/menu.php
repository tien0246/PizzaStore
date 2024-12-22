<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Hệ Thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
    
body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, table, th, td, div, a, button {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(
        rgba(100, 149, 237, 0.5), 
        rgba(176, 196, 222, 0.5) 
    ),
    url("https://t3.ftcdn.net/jpg/05/64/32/70/360_F_564327039_eHOuKCz4S0BZbVbLrdnIj4cSlZimBIe7.jpg")
        fixed;
    background-size: cover;
    color: #333;
    min-height: 100vh;
}

.container {
    background-color: rgba(255, 255, 255, 0.85);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.alert {
    border-radius: 6px;
    padding: 15px 20px;
    margin-bottom: 20px;
    font-size: 16px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.card.menu-card {
    background-color: #ffffff; 
    border: 1px solid #e1e1e1;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.card.menu-card .card-body {
    padding: 20px;
}

.card.menu-card .card-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 10px;
    font-weight: 700;
}

.card.menu-card .card-text {
    font-size: 1rem;
    color: #7f8c8d;
}

.row.justify-content-center {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.col-md-4.p-2 {
    flex: 0 0 30%;
    max-width: 30%;
}

@media (max-width: 992px) {
    .col-md-4.p-2 {
        flex: 0 0 45%;
        max-width: 45%;
    }
}

@media (max-width: 768px) {
    .col-md-4.p-2 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

.btn {
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-primary {
    background-color: #3498db;
    color: #ffffff;
    border: none;
}

.btn-primary:hover {
    background-color: #2980b9;
    color: #ffffff;
}

.btn-secondary {
    background-color: #95a5a6;
    color: #ffffff;
    border: none;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
    color: #ffffff;
}

.food-name::before {
    content: "🍕";
    margin-right: 8px;
}

.status-preparing::after {
    content: "...";
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        content: ".";
    }
    33% {
        content: "..";
    }
    66% {
        content: "...";
    }
}

</style>
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
