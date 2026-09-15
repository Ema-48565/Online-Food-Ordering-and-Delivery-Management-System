<?php

require_once "DatabaseConnection.php";

function getOrders()
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM orders";

    $result = $conn->query($query);

    return $result;
}

function searchOrders($search)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM orders
              WHERE id LIKE '%$search%'";

    $result = $conn->query($query);

    return $result;
}

function getOrder($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM orders WHERE id = $id";

    $result = $conn->query($query);

    return mysqli_fetch_assoc($result);
}

?>