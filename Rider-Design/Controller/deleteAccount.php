<?php
session_start();

$username = $_SESSION["loggedInUser"] ?? "rider_demo";

if ($username) {
    session_destroy();
    setcookie("username", "", time() - 1, "/");
    header("Location: ../View/login.php");
    exit();
}
?>