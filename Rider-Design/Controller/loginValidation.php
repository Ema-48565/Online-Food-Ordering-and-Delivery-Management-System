<?php
session_start();

$username = $_REQUEST["username"] ?? "";
$password = $_REQUEST["password"] ?? "";

$_SESSION["username"] = $username;

if (!$username) {
    $_SESSION["usernameError"] = "Username is required";
} else {
    unset($_SESSION["usernameError"]);
}

if (!$password) {
    $_SESSION["passwordError"] = "Password is required";
} else {
    unset($_SESSION["passwordError"]);
}

if (!$username || !$password) {
    header("Location: ../View/login.php");
    exit();
} else {
    // Demo validation without Database
    if ($username === "rider_demo" && $password === "1234") {
        setcookie("username", $username, time() + 3600, "/");
        $_SESSION["loggedInUser"] = $username;
        $_SESSION["isLoggedIn"] = true;
        header("Location: ../View/dashboard.php");
        exit();
    } else {
        $_SESSION["usernameError"] = "Invalid credentials";
        header("Location: ../View/login.php");
        exit();
    }
}
?>