<?php
class DatabaseConnection {
    public function openConnection() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "delivery_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>