<?php
require_once 'app/Models/Report.php';

class ReportController {
    private $reportModel;

    public function __construct() {
        global $pdo;
        $this->reportModel = new Report($pdo);    
    }
    public function view()
    {
        try {
            $reports = $this->reportModel->getReport();
            require 'app/Views/report_view.php';
        }
        catch (PDOException $e) {
            $_SESSION['error'] = "Lỗi: ". $e->getMessage();
            header("Location: index.php?controller=menu");
            exit();
        }
    }
}
