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
            require 'app/Views/kitchen_view.php';
        } catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }
}
?>
