<?php
session_start();

$orderId = $_GET["id"] ?? "";

if ($orderId) {
    $_SESSION["msg"] = "Order #$orderId accepted successfully!";
}

header("Location: ../View/dashboard.php");
exit();
?>