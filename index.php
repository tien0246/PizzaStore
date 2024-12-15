<?php
session_start();

require_once 'app/Controllers/CustomerController.php';
require_once 'app/Controllers/OrderController.php';
require_once 'app/Controllers/KitchenController.php';
require_once 'app/Controllers/ReportController.php';
require_once 'app/Controllers/EmployeeController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'menu';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'customer':
        $customerController = new CustomerController();
        if ($action === 'create') {
            $customerController->create();
        } elseif ($action === 'store') {
            $customerController->store();
        } elseif ($action === 'list') {
            $customerController->list();
        } else {
            $customerController->create();
        }
        break;
    case 'order':
        $orderController = new OrderController();
        if ($action === 'create') {
            $orderController->create();
        } elseif ($action === 'store') {
            $orderController->store();
        } else {
            $orderController->create();
        }
        break;
    case 'kitchen':
        $kitchenController = new KitchenController();
        if ($action === 'view') {
            $kitchenController->view();
        } else if ($action === 'updateStatus') {
            $kitchenController->updateStatus();
        }
        else {
            $kitchenController->view();
        }
        break;
    case 'report':
        $reportController = new ReportController();
        if ($action === 'view') {
            $reportController->view();
        } else {
            $reportController->view();
        }
        break;
    case 'employee':
        $reportController = new EmployeeController();
        if ($action === 'list') {
            $reportController->list();
        } else {
            $reportController->list();
        }
        break;
    case 'menu':
    default:
        require_once 'app/Views/menu.php';
        break;
}
?>
