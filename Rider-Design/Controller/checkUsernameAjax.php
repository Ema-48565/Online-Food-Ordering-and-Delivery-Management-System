<?php
include('../Model/DatabaseConnection.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $result = $db->checkUsername($conn, $username);

    if ($result->num_rows > 0) {
        echo "taken";
    } else {
        echo "available";
    }
    $conn->close();
}
?>