<?php

require_once "DatabaseConnection.php";

function getUsers()
{
    global $conn;

    $query = "SELECT * FROM users";

    $result = mysqli_query($conn, $query);

    return $result;
}

?>

