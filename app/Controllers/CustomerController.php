<?php
require_once 'app/Models/Customer.php';

class CustomerController {
    private $customerModel;

    public function __construct() {
        global $pdo;
        $this->customerModel = new Customer($pdo);
    }

    public function create() {
        require 'app/Views/customer_create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $hoTen = $_POST['hoTen'];
                $gioiTinh = $_POST['gioiTinh'];
                $soDienThoai = $_POST['soDienThoai'];
                $soNha = $_POST['soNha'];
                $tenDuong = $_POST['tenDuong'];
                $phuongXa = $_POST['phuongXa'];
                $quanHuyen = $_POST['quanHuyen'];
                $tinhThanh = $_POST['tinhThanh'];
                $loaiKH = $_POST['loaiKH'];
                $ngaySinh = $_POST['ngaySinh'];
                $cccd = $_POST['cccd'];
                $this->customerModel->addCustomer($hoTen, $gioiTinh, $soDienThoai, $soNha, $tenDuong, $phuongXa, $quanHuyen, $tinhThanh, $loaiKH, $ngaySinh, $cccd);
                $_SESSION['success'] = "Khách hàng được tạo thành công!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }
            header("Location: index.php?controller=customer&action=create");
            exit();
        }
    }
}
?>
