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
    // Employee.php

    public function getAllEmployees($search = null, $sortColumn = 'MaNV', $sortOrder = 'ASC') {
    // Validate and sanitize input in the controller before passing to the model
        $stmt = $this->pdo->prepare("CALL GetAllNhanVienFilter(:search, :sort_column, :sort_order)");
        if ($search === '') {
            $search = null;
        }
        // Bind parameters
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':sort_column', $sortColumn, PDO::PARAM_STR);
        $stmt->bindParam(':sort_order', $sortOrder, PDO::PARAM_STR);

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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':HoTen', $hoTen, PDO::PARAM_STR);
        $stmt->bindParam(':NgaySinh', $ngaySinh, PDO::PARAM_STR); // Ensure date format matches
        $stmt->bindParam(':CCCD', $cccd, PDO::PARAM_STR);
        $stmt->bindParam(':GioiTinh', $gioiTinh, PDO::PARAM_STR);
        $stmt->bindParam(':SoDienThoai', $soDienThoai, PDO::PARAM_STR);
        $stmt->bindParam(':SoNha', $soNha, PDO::PARAM_STR);
        $stmt->bindParam(':Duong', $duong, PDO::PARAM_STR);
        $stmt->bindParam(':Xa', $xa, PDO::PARAM_STR);
        $stmt->bindParam(':Huyen', $huyen, PDO::PARAM_STR);
        $stmt->bindParam(':Tinh', $tinh, PDO::PARAM_STR);
        $stmt->bindParam(':MaPB', $maPB, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function deleteNhanVien($id) {
        $stmt = $this->pdo->prepare("CALL DeleteNhanVien(:id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
