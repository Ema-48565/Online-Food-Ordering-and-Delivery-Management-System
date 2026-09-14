<?php
class DatabaseConnection {
    // Open database connection
    function openConnection() {
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

    // Check username query
    function checkUsername($conn, $username) {
        $sql = "SELECT * FROM riders WHERE username='$username'";
        return $conn->query($sql);
    }

    // Register rider query
    function registerRider($conn, $username, $password, $phone, $file_path) {
        $sql = "INSERT INTO riders (username, password, phone, file_path) VALUES ('$username', '$password', '$phone', '$file_path')";
        return $conn->query($sql);
    }

    // Login rider query
    function loginRider($conn, $username, $password) {
        $sql = "SELECT * FROM riders WHERE username='$username' AND password='$password'";
        return $conn->query($sql);
    }

    // Get deliveries query
    function getDeliveries($conn, $rider_id) {
        $sql = "SELECT * FROM deliveries WHERE rider_id='$rider_id' OR rider_id IS NULL";
        return $conn->query($sql);
    }

    // Accept delivery query
    function acceptDelivery($conn, $order_id, $rider_id) {
        $sql = "UPDATE deliveries SET status='Accepted', rider_id='$rider_id' WHERE id='$order_id'";
        return $conn->query($sql);
    }

    // Update delivery status query
    function updateDeliveryStatus($conn, $order_id, $status) {
        $sql = "UPDATE deliveries SET status='$status' WHERE id='$order_id'";
        return $conn->query($sql);
    }

    // Get rider by id query
    function getRiderById($conn, $rider_id) {
        $sql = "SELECT * FROM riders WHERE id='$rider_id'";
        return $conn->query($sql);
    }

    // Update profile query
    function updateProfile($conn, $rider_id, $username, $phone) {
        $sql = "UPDATE riders SET username='$username', phone='$phone' WHERE id='$rider_id'";
        return $conn->query($sql);
    }

    // Update password query
    function updatePassword($conn, $rider_id, $new_pass) {
        $sql = "UPDATE riders SET password='$new_pass' WHERE id='$rider_id'";
        return $conn->query($sql);
    }

    // Delete account query
    function deleteAccount($conn, $rider_id) {
        $sql = "DELETE FROM riders WHERE id='$rider_id'";
        return $conn->query($sql);
    }
}
?>