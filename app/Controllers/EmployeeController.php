








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
            ob_start();
            header("Location: index.php?controller=employee&action=list");
            ob_end_flush();
            exit();
        }
    }

    // Display a list of employees
    // EmployeeController.php

    public function list() {
        try {
            // Retrieve search and sort parameters from GET request
            $search = isset($_GET['search']) ? trim($_GET['search']) : null;
            $sortColumn = isset($_GET['sort']) ? trim($_GET['sort']) : 'MaNV';
            $sortOrder = isset($_GET['order']) ? strtoupper(trim($_GET['order'])) : 'ASC';

            // Validate sort order
            if (!in_array($sortOrder, ['ASC', 'DESC'])) {
                $sortOrder = 'ASC';
            }

            // Define allowed sort columns to prevent SQL injection
            $allowedSortColumns = ['MaNV', 'HoTen', 'NgaySinh', 'CanCuocCongDan', 'GioiTinh', 'SoDienThoai', 'SoNha', 'Duong', 'Xa', 'Huyen', 'Tinh', 'MaPB'];
            if (!in_array($sortColumn, $allowedSortColumns)) {
                $sortColumn = 'MaNV';
            }

            // Fetch employees with search and sort parameters
            $employees = $this->employeeModel->getAllEmployees($search, $sortColumn, $sortOrder);

            require 'app/Views/employee_list.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }


    // Show the form to edit an employee
    public function edit($id) {
        try {
            $employee = $this->employeeModel->getEmployeeDetail($id);
            if (!$employee) {
                $_SESSION['error'] = "Không tìm thấy nhân viên với ID: " . htmlspecialchars($id);
                ob_start();
                header("Location: index.php?controller=employee&action=list");
                ob_end_flush();
                exit();
            }
            require 'app/Views/employee_edit.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=employee&action=list");
            exit();
        }
    }

    // Handle updating an employee in the database
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Retrieve and sanitize input data
                $hoTen = trim($_POST['hoTen']);
                $ngaySinh = $_POST['ngaySinh'];
                $cccd = trim($_POST['cccd']);
                $gioiTinh = $_POST['gioiTinh'];
                $soDienThoai = trim($_POST['soDienThoai']);
                $soNha = trim($_POST['soNha']);
                $duong = trim($_POST['duong']);
                $xa = trim($_POST['xa']);
                $huyen = trim($_POST['huyen']);
                $tinh = trim($_POST['tinh']);
                $maPB = trim($_POST['maPB']);

                // Validate required fields
                if (empty($hoTen) || empty($ngaySinh) || empty($cccd) || empty($gioiTinh) || empty($soDienThoai) || empty($soNha) || empty($duong) || empty($xa) || empty($huyen) || empty($tinh) || empty($maPB)) {
                    throw new Exception("Vui lòng điền đầy đủ các trường.");
                }

                // Optionally, add more validation (e.g., format of date, phone number)

                // Update the employee in the database
                $this->employeeModel->updateNhanVien($id, $hoTen, $ngaySinh, $cccd, $gioiTinh, $soDienThoai, $soNha, $duong, $xa, $huyen, $tinh, $maPB);

                $_SESSION['success'] = "Nhân viên đã được cập nhật thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi CSDL: " . $e->getMessage();
            }

            ob_start();
            header("Location: index.php?controller=employee&action=list");
            ob_end_flush();

            exit();
        } else {
            // If not a POST request, redirect to the employee list
            $_SESSION['error'] = "Yêu cầu không hợp lệ.";
            header("Location: index.php?controller=employee&action=list");
            exit();
        }
    }
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->employeeModel->deleteNhanVien($id);
                $_SESSION['success'] = "Nhân viên đã được xoá!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }

            ob_start();
            header("Location: index.php?controller=employee&action=list");
            ob_end_flush();

            exit();
        }
    }
}
?>
