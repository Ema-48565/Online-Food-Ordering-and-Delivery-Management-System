<?php
require_once "../../DatabaseConnection.php";
require_once "../Model/ManagerModel.php";

$database = new DatabaseConnection();
$conn = $database->openConnection();
$model = new ManagerModel($conn);

$totalOrders = $model->getTotalOrders();
$todayRevenue = $model->getTodayRevenue();
$pendingOrders = $model->getPendingOrdersCount();
$completedOrders = $model->getCompletedOrdersCount();
$recent = $model->getRecentOrders();

include "../View/dashboard.php";
?>