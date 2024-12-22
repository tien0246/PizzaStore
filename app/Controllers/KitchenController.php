<?php
require_once 'app/Models/Kitchen.php';

class KitchenController {
    private $kitchenModel;

    public function __construct() {
        global $pdo;
        $this->kitchenModel = new Kitchen($pdo);
    }
    public function view() {
        try {
            $dishes = $this->kitchenModel->getDishesToPrepare();
            $foods = $this->kitchenModel->getAllMonAn();
            foreach ($dishes as &$dish) {
                foreach ($foods as $food) {
                    if ($dish['MaMon'] === $food['MaMon']) {
                        $dish['TenMon'] = $food['TenMon'];
                        break;
                    }
                }
            }
            unset($dish); 
            require 'app/Views/kitchen_view.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maMon = $_POST['MaMon'] ?? null;
            $maDH = $_POST['MaDH'] ?? null; // Corrected field name from 'Status' to 'MaDH'
    
            if ($maMon && $maDH) {
                $this->kitchenModel->UpdateThucThi($maDH, $maMon);
            }
        }
    
        // Redirect back to the main page
        // header("Location: index.php?controller=kitchen&action=view");
        require 'app/Views/kitchen_view.php';
        exit;
    }
}
?>
