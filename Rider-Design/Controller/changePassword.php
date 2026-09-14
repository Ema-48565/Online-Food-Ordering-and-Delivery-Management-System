<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['change_pass'])) {
    $rider_id = $_SESSION['rider_id'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $result = $db->getRiderById($conn, $rider_id);
    $row = $result->fetch_assoc();

    if ($row['password'] == $old_pass) {
        $db->updatePassword($conn, $rider_id, $new_pass);
        $conn->close();
        header("Location: ../View/profile.php?success=Password changed");
        exit();
    } else {
        $conn->close();
        header("Location: ../View/profile.php?error=Old password incorrect");
        exit();
    }
}
?>