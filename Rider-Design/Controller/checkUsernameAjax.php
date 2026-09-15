<?php
include('../Model/RiderModel.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $riderModel = new RiderModel();
    $result = $riderModel->checkUsername($username);

    if ($result->num_rows > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>