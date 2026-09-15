<?php

session_start();

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

if ($username == "admin" && $password == "1234") {

    $_SESSION["loggedInUser"] = $username;
    $_SESSION["isLoggedIn"] = true;

    header("Location: dashboard_check.php");
    exit();

} else {

    $_SESSION["loginError"] = "Incorrect username or password";

    header("Location: ../View/login.php");
    exit();
}

?>