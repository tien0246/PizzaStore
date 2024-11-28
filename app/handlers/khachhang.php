<?php
require '../db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'add':
        addKhachHang($pdo);
        break;
    default:
        echo "Hành động không hợp lệ!";
}

function addKhachHang($pdo) {
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $soDienThoai = $_POST['soDienThoai'];
    $diaChi = $_POST['diaChi'];
    $loaiKH = $_POST['loaiKH'];

    try {
        $stmt = $pdo->prepare("INSERT INTO KhachHang (HoTen, GioiTinh, SoDienThoai, DiaChi, LoaiKH) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$hoTen, $gioiTinh, $soDienThoai, $diaChi, $loaiKH]);
        echo "Thêm khách hàng thành công!";
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
