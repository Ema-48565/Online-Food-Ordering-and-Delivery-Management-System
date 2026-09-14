<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $db->updateDeliveryStatus($conn, $order_id, $status);
    $conn->close();

    header("Location: ../View/dashboard.php");
    exit();
}
?>