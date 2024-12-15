<?php
require_once 'connection.php';

class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addOrder($thoiGianTao, $loaiDH, $maKH, $thoiGianHenGiao, $thoiGianDatBan) {
        $stmt = $this->pdo->prepare("CALL AddDonHang(:ThoiGianTao, 0, 0, NULL, NULL, 'Dang xu ly', NULL, :LoaiDH, NULL, :MaKH, :ThoiGianHenGiao, :ThoiGianDatBan, NULL)");
        $stmt->bindParam(':ThoiGianTao', $thoiGianTao);
        $stmt->bindParam(':LoaiDH', $loaiDH);
        $stmt->bindParam(':MaKH', $maKH);
        $stmt->bindParam(':ThoiGianHenGiao', $thoiGianHenGiao);
        $stmt->bindParam(':ThoiGianDatBan', $thoiGianDatBan);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function addOrderDetail($maDH, $maMon, $soLuong, $gia, $ghiChu) {
        $stmt = $this->pdo->prepare("CALL AddDonHangChiTiet(:MaDH, :MaMon, :SoLuong, :Gia, :GhiChu)");
        $stmt->bindParam(':MaDH', $maDH);
        $stmt->bindParam(':MaMon', $maMon);
        $stmt->bindParam(':SoLuong', $soLuong);
        $stmt->bindParam(':Gia', $gia);
        $stmt->bindParam(':GhiChu', $ghiChu);
        $stmt->execute();
    }

    public function getAllMonAn() {
        $stmt = $this->pdo->prepare("SELECT * FROM MonAn");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCustomers() {
        $stmt = $this->pdo->prepare("SELECT * FROM KhachHang");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
