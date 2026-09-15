<?php
session_start();
require_once "../Model/admin_model.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

if ($username == "") {
    $_SESSION["usernameError"] = "Username is required";
} else {
    unset($_SESSION["usernameError"]);
}

if ($password == "") {
    $_SESSION["passwordError"] = "Password is required";
} else {
    unset($_SESSION["passwordError"]);
}

if ($username == "" || $password == "") {
    header("Location: ../View/login.php");
    exit();
}

$admin = getAdmin($username, $password);

if ($admin) {
    $_SESSION["loggedInUser"] = $admin["username"];
    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["isLoggedIn"] = true;
    header("Location: ../View/dashboard.php");
    exit();
} else {
    $_SESSION["loginError"] = "Incorrect username or password";
    header("Location: ../View/login.php");
    exit();
}