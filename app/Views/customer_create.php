<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/Views/css/style.css">
</head>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #9face6); /* Gradient background with soft blue and green */
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        background: #ffffff; /* White background for the form container */
        border-radius: 8px; /* Rounded corners for the container */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        padding: 2rem;
        max-width: 600px;
        margin: 2rem auto;
        border: 1px solid #e3e3e3; /* Light border for a structured look */
    }

    h2 {
        text-align: center;
        font-weight: bold;
        color: #16a085; /* Accent color */
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-size: 0.95rem;
        font-weight: 500;
        color: #555;
    }

    .form-control, .form-select {
        border-radius: 6px; /* Rounded inputs */
        border: 1px solid #ccc; /* Neutral border color */
        padding: 0.6rem;
        font-size: 0.95rem;
        color: #333;
        background-color: #f9f9f9; /* Soft background for inputs */
    }

    .form-control:focus, .form-select:focus {
        border-color: #5c8df6; /* Subtle blue for focused inputs */
        box-shadow: 0 0 5px rgba(92, 141, 246, 0.5); /* Matching glow effect */
        outline: none;
    }

    .btn-primary {
        background-color: #5c8df6; /* Calm blue for the primary button */
        border-color: #5c8df6;
        color: #fff;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease;
        border: #333333;
    }

    .btn-primary:hover {
        background-color:rgb(15, 82, 218); /* Darker shade for hover */
        
    }

    .btn-secondary {
        background-color:rgb(223, 216, 216); /* Neutral grey for secondary button */
        border-color: #ccc;
        color: #555;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        border:rgb(122, 158, 229)
    }

    .btn-secondary:hover {
        background-color:rgb(168, 170, 169); /* Slightly darker grey on hover */
        border:rgb(122, 158, 229)
    }

    .alert {
        border-radius: 6px; /* Rounded alert boxes */
        font-size: 0.95rem;
    }

    .alert-success {
        background-color: #e6f8e6; /* Light green background for success */
        color: #356435; /* Dark green text for success */
        border-color: #d4f0d4;
    }

    .alert-error {
        background-color: #f8e6e6; /* Light red background for errors */
        color: #643535; /* Dark red text for errors */
        border-color: #f0d4d4;
    }

    button {
        cursor: pointer;
    }

    button:focus {
        outline: none;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1.5rem;
        }
    }
</style>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tạo Khách Hàng Mới</h2>
        
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
        
        <form method="POST" action="index.php?controller=customer&action=store">
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới Tính</label>
                <select class="form-select" name="gioiTinh" required>
                    <option value="M">Nam</option>
                    <option value="F">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" required>
            </div>
            <div class="mb-3">
                <label for="soNha" class="form-label">Số Nhà</label>
                <input type="text" class="form-control" id="soNha" name="soNha" required>
            </div>
            <div class="mb-3">
                <label for="tenDuong" class="form-label">Tên Đường</label>
                <input type="text" class="form-control" id="tenDuong" name="tenDuong" required>
            </div>
            <div class="mb-3">
                <label for="phuongXa" class="form-label">Phường/Xã</label>
                <input type="text" class="form-control" id="phuongXa" name="phuongXa" required>
            </div>
            <div class="mb-3">
                <label for="quanHuyen" class="form-label">Quận/Huyện</label>
                <input type="text" class="form-control" id="quanHuyen" name="quanHuyen" required>
            </div>
            <div class="mb-3">
                <label for="tinhThanh" class="form-label">Tỉnh/Thành</label>
                <input type="text" class="form-control" id="tinhThanh" name="tinhThanh" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Loại Khách Hàng</label>
                <select class="form-select" name="loaiKH" required>
                    <option value="Ca nhan">Cá nhân</option>
                    <option value="Ung dung">Ứng dụng</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh">
            </div>
            <div class="mb-3">
                <label for="cccd" class="form-label">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo Khách Hàng</button>
            <a href="index.php" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
