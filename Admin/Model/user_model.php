<?php

require_once "../../DatabaseConnection.php";

function getUsers()
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM users";

    $result = $conn->query($query);

    return $result;
}

?>



