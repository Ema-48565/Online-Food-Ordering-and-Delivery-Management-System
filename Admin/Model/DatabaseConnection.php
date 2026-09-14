<?php

class DatabaseConnection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "delivery_db";

    function openConnection()
    {
        $conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function closeConnection($conn)
    {
        $conn->close();
    }
}

?>

