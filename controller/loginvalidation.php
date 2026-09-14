<?php
include "../Model/DatabaseConnection.php";
session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

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
    Header("Location: ../View/login.php");
    exit();
}

$database = new DatabaseConnection();
$connection = $database->openConnection();
$result = $database->signin($connection, $username, $password);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION["loggedInUsername"] = $row["username"];
    $_SESSION["customer_id"] = $row["id"];
    $_SESSION["isLoggedIn"] = true;
    Header("Location: ../View/customer_home.php");
} else {
    $_SESSION["loginFailMessage"] = "Username or password is incorrect!";
    Header("Location: ../View/login.php");
}
exit();
?>