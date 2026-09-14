<?php
include "../Model/DatabaseConnection.php";
session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";
$phone = $_POST["phone"] ?? "";
$file = $_FILES["fileupload"] ?? null;

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
    Header("Location: ../View/registration.php");
    exit();
} else {
    $path = "";
    if ($file && $file["name"]) {
        $uploadDirectory = "../uploads/";
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
        $path = $uploadDirectory . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $path);
    }

    $database = new DatabaseConnection();
    $connection = $database->openConnection();
    $result = $database->signup($connection, $username, $password, $phone, $path);

    if ($result) {
        Header("Location: ../View/login.php");
    } else {
        echo "Failed to register";
    }
    exit();
}
?>