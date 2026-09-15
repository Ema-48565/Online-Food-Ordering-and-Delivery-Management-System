<?php

require_once "DatabaseConnection.php";

function getRestaurants()
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM restaurants";

    $result = $conn->query($query);

    return $result;
}

function searchRestaurants($search)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM restaurants
              WHERE name LIKE '%$search%'
              OR owner LIKE '%$search%'
              OR location LIKE '%$search%'";

    $result = $conn->query($query);

    return $result;
}

function addRestaurant($name, $owner, $location, $contact, $status)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "INSERT INTO restaurants
              (name, owner, location, contact, status)
              VALUES
              ('$name', '$owner', '$location', '$contact', '$status')";

    $conn->query($query);
}

function getRestaurant($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM restaurants WHERE id = $id";

    $result = $conn->query($query);

    return mysqli_fetch_assoc($result);
}

function updateRestaurant($id, $name, $owner, $location, $contact, $status)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "UPDATE restaurants SET
              name = '$name',
              owner = '$owner',
              location = '$location',
              contact = '$contact',
              status = '$status'
              WHERE id = $id";

    $conn->query($query);
}

function blockRestaurant($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "UPDATE restaurants SET status = 'Blocked' WHERE id = $id";

    $conn->query($query);
}

function unblockRestaurant($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "UPDATE restaurants SET status = 'Active' WHERE id = $id";

    $conn->query($query);
}

?>