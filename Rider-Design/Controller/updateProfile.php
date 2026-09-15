<?php
session_start();

$phone = $_POST["phone"] ?? "";
$username = $_SESSION["loggedInUser"] ?? "rider_demo";

if ($username && $phone) {
    $_SESSION["phone"] = $phone; 
    $_SESSION["msg"] = "Profile updated successfully!";
}

header("Location: ../View/profile.php");
exit();
?>