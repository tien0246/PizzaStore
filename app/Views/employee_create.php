<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Thêm Nhân Viên</title>
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
        color: #16a085; /* Accent color */
    }

    /* Alerts */
    .alert {
        border-radius: 5px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    /* Input Fields & Form Styling */
    .form-control {
        border-color: #16a085; /* Accent color */
        background-color: #f0f4f4;
        color: #333;
    }

    .form-control:focus {
        border-color: #1abc9c; /* Slightly darker green for focus */
        box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
    }

    .form-select {
        background-color: #f0f4f4;
        border-color: #16a085;
        color: #333;
    }

    .form-select:focus {
        border-color: #1abc9c;
        box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
    }

    /* Buttons */
    .btn-primary {
        background-color: #16a085;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        color: #ffffff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1abc9c; /* Hover effect with darker color */
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

    /* Responsive Design */
    @media (max-width: 768px) {
        h2 {
            font-size: 20px;
            padding-bottom: 8px;
        }

        .form-control {
            font-size: 14px;
            padding: 8px;
        }

        .btn-primary,
        .btn-secondary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
</style>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Nhân Viên</h2>
        <form method="POST" action="index.php?controller=employee&action=store">
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" placeholder="Nhập họ tên" required>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" required>
            </div>
            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" placeholder="Nhập CCCD" required>
            </div>
            <div class="mb-3">
                <label for="gioiTinh" class="form-label">Giới Tính</label>
                <select class="form-select" id="gioiTinh" name="gioiTinh" required>
                    <option value="M">Nam</option>
                    <option value="F">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" placeholder="Nhập số điện thoại" required>
            </div>
            <!-- Address Fields -->
            <div class="mb-3">
                <label for="soNha" class="form-label">Số Nhà</label>
                <input type="text" class="form-control" id="soNha" name="soNha" placeholder="Nhập số nhà" required>
            </div>
            <div class="mb-3">
                <label for="duong" class="form-label">Đường</label>
                <input type="text" class="form-control" id="duong" name="duong" placeholder="Nhập tên đường" required>
            </div>
            <div class="mb-3">
                <label for="xa" class="form-label">Xã</label>
                <input type="text" class="form-control" id="xa" name="xa" placeholder="Nhập tên xã" required>
            </div>
            <div class="mb-3">
                <label for="huyen" class="form-label">Huyện</label>
                <input type="text" class="form-control" id="huyen" name="huyen" placeholder="Nhập tên huyện" required>
            </div>
            <div class="mb-3">
                <label for="tinh" class="form-label">Tỉnh</label>
                <input type="text" class="form-control" id="tinh" name="tinh" placeholder="Nhập tên tỉnh" required>
            </div>
            <div class="mb-3">
                <label for="maPB" class="form-label">Phòng Ban</label>
                <input type="text" class="form-control" id="maPB" name="maPB" placeholder="Nhập mã phòng ban" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
