<?php
include('../Model/RiderModel.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $riderModel = new RiderModel();

    $check_result = $riderModel->checkUsername($username);
    if ($check_result->num_rows > 0) {
        header("Location: ../View/registration.php?error=Username already taken!");
        exit();
    }

    $file_path = "";
    if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
        $file_path = "../uploads/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }

    if ($riderModel->registerRider($username, $password, $phone, $file_path) === TRUE) {
        header("Location: ../View/login.php?success=Registration successful");
        exit();
    } else {
        header("Location: ../View/registration.php?error=Database error");
        exit();
    }
}
?>