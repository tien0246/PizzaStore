<?php
require_once 'connection.php';

class Employee {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Add a new employee
    public function addEmployee($hoTen, $ngaySinh, $cccd, $gioiTinh, $soDienThoai, $soNha, $duong, $xa, $huyen, $tinh, $maPB) {
        $stmt = $this->pdo->prepare("CALL AddNhanVien(:HoTen, :NgaySinh, :CCCD, :GioiTinh, :SoDienThoai, :SoNha, :Duong, :Xa, :Huyen, :Tinh, :MaPB)");
        $stmt->bindParam(':HoTen', $hoTen);
        $stmt->bindParam(':NgaySinh', $ngaySinh);
        $stmt->bindParam(':CCCD', $cccd);
        $stmt->bindParam(':GioiTinh', $gioiTinh);
        $stmt->bindParam(':SoDienThoai', $soDienThoai);
        $stmt->bindParam(':SoNha', $soNha);
        $stmt->bindParam(':Duong', $duong);
        $stmt->bindParam(':Xa', $xa);
        $stmt->bindParam(':Huyen', $huyen);
        $stmt->bindParam(':Tinh', $tinh);
        $stmt->bindParam(':MaPB', $maPB);
        $stmt->execute();
    }

    // Get all employees
    public function getAllEmployees() {
        $stmt = $this->pdo->prepare("CALL GetAllNhanVien()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get details of a specific employee
    public function getEmployeeDetail($id) {
        $stmt = $this->pdo->prepare("CALL GetNhanVienById(:id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an employee
    public function updateNhanVien($id, $hoTen, $ngaySinh, $cccd, $gioiTinh, $soDienThoai, $soNha, $duong, $xa, $huyen, $tinh, $maPB) {
        $stmt = $this->pdo->prepare("CALL UpdateNhanVien(:id, :HoTen, :NgaySinh, :CCCD, :GioiTinh, :SoDienThoai, :SoNha, :Duong, :Xa, :Huyen, :Tinh, :MaPB)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':HoTen', $hoTen);
        $stmt->bindParam(':NgaySinh', $ngaySinh);
        $stmt->bindParam(':CCCD', $cccd);
        $stmt->bindParam(':GioiTinh', $gioiTinh);
        $stmt->bindParam(':SoDienThoai', $soDienThoai);
        $stmt->bindParam(':SoNha', $soNha);
        $stmt->bindParam(':Duong', $duong);
        $stmt->bindParam(':Xa', $xa);
        $stmt->bindParam(':Huyen', $huyen);
        $stmt->bindParam(':Tinh', $tinh);
        $stmt->bindParam(':MaPB', $maPB);
        $stmt->execute();
    }
}
?>
