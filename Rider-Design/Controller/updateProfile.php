<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_POST['update'])) {
    $rider_id = $_SESSION['rider_id'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    if ($db->updateProfile($conn, $rider_id, $username, $phone) === TRUE) {
        $_SESSION['rider_username'] = $username;
        $conn->close();
        header("Location: ../View/profile.php?success=Updated successfully");
        exit();
    } else {
        $conn->close();
        header("Location: ../View/profile.php?error=Update failed");
        exit();
    }
}
?>