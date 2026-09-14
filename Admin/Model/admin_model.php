<?php

require_once "../../DatabaseConnection.php";

function getAdmin($username, $password)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM admins
              WHERE username='$username'
              AND password='$password'";

    $result = $conn->query($query);

    return $result->fetch_assoc();
}

?>

