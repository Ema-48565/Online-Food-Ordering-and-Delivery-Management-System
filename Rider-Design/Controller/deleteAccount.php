<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: ../View/login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];

$db = new DatabaseConnection();
$conn = $db->openConnection();

if ($db->deleteAccount($conn, $rider_id) === TRUE) {
    $conn->close();
    session_unset();
    session_destroy();
    header("Location: ../View/login.php?success=Account deleted successfully");
    exit();
} else {
    $conn->close();
    header("Location: ../View/profile.php?error=Failed to delete account");
    exit();
}
?>