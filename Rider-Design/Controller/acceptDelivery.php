<?php
session_start();
include('../Model/RiderModel.php'); 

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $rider_id = $_SESSION['rider_id'];

    $riderModel = new RiderModel();
    $riderModel->acceptDelivery($order_id, $rider_id);

    header("Location: ../View/dashboard.php");
    exit();
}
?>