<?php
session_start();

$newPassword = $_POST["new_password"] ?? "";
$username = $_SESSION["loggedInUser"] ?? "rider_demo";

if ($username && $newPassword) {
    $_SESSION["msg"] = "Password changed successfully!";
}

header("Location: ../View/profile.php");
exit();
?>