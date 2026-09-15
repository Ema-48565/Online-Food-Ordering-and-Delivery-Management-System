<?php
session_start();
include('../Model/RiderModel.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: ../View/login.php?error=Empty fields");
        exit();
    }
    
    $riderModel = new RiderModel();
    $result = $riderModel->loginRider($username, $password);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['rider_id'] = $row['id'];
        $_SESSION['rider_username'] = $row['username'];
        header("Location: ../View/dashboard.php");
        exit();
    } else {
        header("Location: ../View/login.php?error=Invalid username or password");
        exit();
    }
}
?>