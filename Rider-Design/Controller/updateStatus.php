<?php
session_start();

$orderId = $_GET["id"] ?? "";
$status = $_GET["status"] ?? "";

if ($orderId && $status) {
    $_SESSION["msg"] = "Order #$orderId updated to $status!";
}

header("Location: ../View/dashboard.php");
exit();
?>