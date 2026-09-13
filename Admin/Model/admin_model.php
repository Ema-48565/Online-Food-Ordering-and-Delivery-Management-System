<?php

require_once "DatabaseConnection.php";

function getAdmin($username, $password)
{
    global $conn;

    $query = "SELECT * FROM admins 
              WHERE username = '$username' 
              AND password = '$password'";

    $result = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($result);
}

?>

