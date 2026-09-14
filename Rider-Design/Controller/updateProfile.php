<?php
session_start();
include('../Model/RiderModel.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['update'])) {
    $rider_id = $_SESSION['rider_id'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    $riderModel = new RiderModel();

    if ($riderModel->updateProfile($rider_id, $username, $phone) === TRUE) {
        $_SESSION['rider_username'] = $username;
        header("Location: ../View/profile.php?success=Updated successfully");
        exit();
    } else {
        header("Location: ../View/profile.php?error=Update failed");
        exit();
    }
}
?>