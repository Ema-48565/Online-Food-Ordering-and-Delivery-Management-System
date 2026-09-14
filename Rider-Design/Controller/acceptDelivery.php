<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $rider_id = $_SESSION['rider_id'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $db->acceptDelivery($conn, $order_id, $rider_id);
    $conn->close();

    header("Location: ../View/dashboard.php");
    exit();
}
?>