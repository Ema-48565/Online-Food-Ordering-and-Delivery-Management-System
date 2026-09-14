<?php
session_start();
include('../Model/RiderModel.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $riderModel = new RiderModel();
    $riderModel->updateDeliveryStatus($order_id, $status);

    header("Location: ../View/dashboard.php");
    exit();
}
?>