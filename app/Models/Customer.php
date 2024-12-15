<?php
require_once 'connection.php';

class Customer {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addCustomer($hoTen, $gioiTinh, $soDienThoai, $soNha, $tenDuong, $phuongXa, $quanHuyen, $tinhThanh, $loaiKH, $ngaySinh, $cccd) {
        $stmt = $this->pdo->prepare("CALL AddKhachHang(:HoTen, :GioiTinh, :SoDienThoai, :SoNha, :TenDuong, :PhuongXa, :QuanHuyen, :TinhThanh, :LoaiKH, :NgaySinh, :CCCD)");
        $stmt->bindParam(':HoTen', $hoTen);
        $stmt->bindParam(':GioiTinh', $gioiTinh);
        $stmt->bindParam(':SoDienThoai', $soDienThoai);
        $stmt->bindParam(':SoNha', $soNha);
        $stmt->bindParam(':TenDuong', $tenDuong);
        $stmt->bindParam(':PhuongXa', $phuongXa);
        $stmt->bindParam(':QuanHuyen', $quanHuyen);
        $stmt->bindParam(':TinhThanh', $tinhThanh);
        $stmt->bindParam(':LoaiKH', $loaiKH);
        $stmt->bindParam(':NgaySinh', $ngaySinh);
        $stmt->bindParam(':CCCD', $cccd);
        $stmt->execute();
    }
}
?>
