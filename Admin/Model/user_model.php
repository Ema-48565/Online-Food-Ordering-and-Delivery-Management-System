<?php

require_once "DatabaseConnection.php";

function getUsers()
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM users";

    $result = $conn->query($query);

    return $result;
}

function searchUsers($search)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "SELECT * FROM users
              WHERE name LIKE '%$search%'
              OR email LIKE '%$search%'";

    $result = $conn->query($query);

    return $result;
}

function blockUser($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "UPDATE users SET status = 'Blocked' WHERE id = $id";

    $conn->query($query);
}

function unblockUser($id)
{
    $db = new DatabaseConnection();

    $conn = $db->openConnection();

    $query = "UPDATE users SET status = 'Active' WHERE id = $id";

    $conn->query($query);
}

?>