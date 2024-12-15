








<?php
require_once 'app/Models/Employee.php';

class EmployeeController {
    private $employeeModel;

    public function __construct() {
        global $pdo;
        $this->employeeModel = new Employee($pdo);
    }

    // Show the form to create a new employee
    public function create() {
        require 'app/Views/employee_create.php';
    }

    // Handle storing the new employee in the database
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $hoTen = $_POST['hoTen'];
                $ngaySinh = $_POST['ngaySinh'];
                $cccd = $_POST['cccd'];
                $gioiTinh = $_POST['gioiTinh'];
                $soDienThoai = $_POST['soDienThoai'];
                $soNha = $_POST['soNha'];
                $duong = $_POST['duong'];
                $xa = $_POST['xa'];
                $huyen = $_POST['huyen'];
                $tinh = $_POST['tinh'];
                $maPB = $_POST['maPB'];
                
                $this->employeeModel->addEmployee($hoTen, $ngaySinh, $cccd, $gioiTinh, $soDienThoai, $soNha, $duong, $xa, $huyen, $tinh, $maPB);
                
                $_SESSION['success'] = "Nhân viên được tạo thành công!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }
            header("Location: index.php?controller=employee&action=list");
            exit();
        }
    }

    // Display a list of employees
    public function list() {
        try {
            $employees = $this->employeeModel->getAllEmployees();
            require 'app/Views/employee.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }

    // Show the form to edit an employee
    public function edit($id) {
        $employee = $this->employeeModel->getEmployeeDetail($id);
        require 'app/Views/employee_edit.php';
    }

    // Handle updating an employee in the database
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $hoTen = $_POST['hoTen'];
                $ngaySinh = $_POST['ngaySinh'];
                $cccd = $_POST['cccd'];
                $gioiTinh = $_POST['gioiTinh'];
                $soDienThoai = $_POST['soDienThoai'];
                $soNha = $_POST['soNha'];
                $duong = $_POST['duong'];
                $xa = $_POST['xa'];
                $huyen = $_POST['huyen'];
                $tinh = $_POST['tinh'];
                $maPB = $_POST['maPB'];
                
                $this->employeeModel->updateNhanVien($id, $hoTen, $ngaySinh, $cccd, $gioiTinh, $soDienThoai, $soNha, $duong, $xa, $huyen, $tinh, $maPB);
                
                $_SESSION['success'] = "Nhân viên đã được cập nhật!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }
            header("Location: index.php?controller=employee&action=list");
            exit();
        }
    }
}
?>
