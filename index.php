<?php
session_start();

require_once 'app/Controllers/CustomerController.php';
require_once 'app/Controllers/OrderController.php';
require_once 'app/Controllers/KitchenController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'menu';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'customer':
        $customerController = new CustomerController();
        if ($action === 'create') {
            $customerController->create();
        } elseif ($action === 'store') {
            $customerController->store();
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
        } else {
            $kitchenController->view();
        }
        break;
    case 'menu':
    default:
        require_once 'app/Views/menu.php';
        break;
}
?>
