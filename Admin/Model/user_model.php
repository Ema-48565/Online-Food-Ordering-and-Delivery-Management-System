<?php
require_once "../../DatabaseConnection.php";

function getUsers()
{
    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $query = "SELECT * FROM users";
    $result = $conn->query($query);

    // সংযোগ ক্লোজ করার বিষয়টি এখানে রাখা নিরাপদ
    $conn->close();
    return $result;
}
?>