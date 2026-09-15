<?php
session_start();
include('../Model/RiderModel.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['change_pass'])) {
    $rider_id = $_SESSION['rider_id'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];

    $riderModel = new RiderModel();
    $result = $riderModel->getRiderById($rider_id);
    $row = $result->fetch_assoc();

    if ($row['password'] == $old_pass) {
        $riderModel->updatePassword($rider_id, $new_pass);
        header("Location: ../View/profile.php?success=Password changed");
        exit();
    } else {
        header("Location: ../View/profile.php?error=Old password incorrect");
        exit();
    }
}
?>