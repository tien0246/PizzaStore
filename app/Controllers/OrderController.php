<?php
require_once 'app/Models/Order.php';

class OrderController {
    private $orderModel;

    public function __construct() {
        global $pdo;
        $this->orderModel = new Order($pdo);
    }

    public function create() {
        try {
            $monAn = $this->orderModel->getAllMonAn();
            $customers = $this->orderModel->getAllCustomers();
            require 'app/Views/order_create.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $thoiGianTao = date('Y-m-d H:i:s');
                $loaiDH = $_POST['loaiDH'];
                $maKH = $_POST['maKH'] ? $_POST['maKH'] : null;
                $thoiGianHenGiao = $_POST['thoiGianHenGiao'] ? $_POST['thoiGianHenGiao'] : null;
                $thoiGianDatBan = $_POST['thoiGianDatBan'] ? $_POST['thoiGianDatBan'] : null;
                $maDH = $this->orderModel->addOrder($thoiGianTao, $loaiDH, $maKH, $thoiGianHenGiao, $thoiGianDatBan);
                foreach ($_POST['monAn'] as $index => $maMon) {
                    $soLuong = $_POST['soLuong'][$index];
                    $gia = $_POST['gia'][$index];
                    $ghiChu = $_POST['ghiChu'][$index];
                    $this->orderModel->addOrderDetail($maDH, $maMon, $soLuong, $gia, $ghiChu);
                }
                $_SESSION['success'] = "Đơn hàng được tạo thành công!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }
            header("Location: index.php?controller=order&action=create");
            exit();
        }
    }
}
?>
