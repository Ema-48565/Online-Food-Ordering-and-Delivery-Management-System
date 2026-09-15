<?php
require_once "../../DatabaseConnection.php";
require_once "../Model/ManagerModel.php";

$database = new DatabaseConnection();
$conn = $database->openConnection();
$model = new ManagerModel($conn);

if (isset($_POST['change_status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];
    $allowed = ['Pending', 'Preparing', 'Ready', 'Completed'];
    if (in_array($status, $allowed, true)) {
        $model->updateOrderStatus($id, $status);
    }
    header("Location: OrderController.php");
    exit;
}

$filter = $_GET['status'] ?? 'All';
$allowed = ['All', 'Pending', 'Preparing', 'Ready', 'Completed'];
if (!in_array($filter, $allowed, true)) {
    $filter = 'All';
}

$orders = $model->getOrdersByStatus($filter);

include "../View/orders.php";
?>