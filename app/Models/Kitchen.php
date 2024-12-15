<?php
require_once 'connection.php';

class Kitchen {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getAllMonAn() {
        $stmt = $this->pdo->prepare("CALL GetAllMonAn()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDishesToPrepare() {
        $stmt = $this->pdo->prepare("CALL GetMonChuaHoanThanh()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function UpdateThucThi($DonHang, $MaMon) {
        $stmt = $this->pdo->prepare("CALL UpdateStatusThucThi(:MaDH, :MaMon)");
        $stmt->bindParam(':MaDH', $DonHang, PDO::PARAM_INT);
        $stmt->bindParam(':MaMon', $MaMon, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
