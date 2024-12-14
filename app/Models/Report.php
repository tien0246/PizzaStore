<?php
require_once 'connection.php';

class Report {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getReport() {
        $stmt = $this->pdo->prepare("SELECT * FROM BaoCaoDoanhThuTheoNgay");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>