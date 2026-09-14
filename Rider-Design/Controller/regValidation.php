<?php
include('../Model/DatabaseConnection.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    //check backend username
    $check_result = $db->checkUsername($conn, $username);
    if ($check_result->num_rows > 0) {
        $conn->close();
        header("Location: ../View/registration.php?error=Username already taken!");
        exit();
    }

    $file_path = "";
    if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
        $file_path = "../uploads/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }

    if ($db->registerRider($conn, $username, $password, $phone, $file_path) === TRUE) {
        $conn->close();
        header("Location: ../View/login.php?success=Registration successful");
        exit();
    } else {
        $conn->close();
        header("Location: ../View/registration.php?error=Database error");
        exit();
    }
}
?>