<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
    <link rel="stylesheet" href="app/Views/css/order_create.css">
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
