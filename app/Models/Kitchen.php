<?php
require_once 'connection.php';

class Kitchen {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getDishesToPrepare() {
        $stmt = $this->pdo->prepare("SELECT * FROM ThucThi WHERE Status != 'Hoan tat'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
