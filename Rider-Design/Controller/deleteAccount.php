<?php
session_start();
include('../Model/RiderModel.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];
$riderModel = new RiderModel();

if ($riderModel->deleteAccount($rider_id) === TRUE) {
    session_unset();
    session_destroy();
    header("Location: ../View/login.php?success=Account deleted successfully");
    exit();
} else {
    header("Location: ../View/profile.php?error=Failed to delete account");
    exit();
}
?>