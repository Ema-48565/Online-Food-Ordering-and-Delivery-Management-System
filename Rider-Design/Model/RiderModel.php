<?php
require_once "DatabaseConnection.php";

class RiderModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new DatabaseConnection();
        $this->conn = $this->db->openConnection();
    }

    // Destructor to close connection automatically when object is destroyed
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function checkUsername($username) {
        $sql = "SELECT * FROM riders WHERE username='$username'";
        return $this->conn->query($sql);
    }

    public function registerRider($username, $password, $phone, $file_path) {
        $sql = "INSERT INTO riders (username, password, phone, file_path) VALUES ('$username', '$password', '$phone', '$file_path')";
        return $this->conn->query($sql);
    }

    public function loginRider($username, $password) {
        $sql = "SELECT * FROM riders WHERE username='$username' AND password='$password'";
        return $this->conn->query($sql);
    }

    public function getDeliveries($rider_id) {
        $sql = "SELECT * FROM deliveries WHERE rider_id='$rider_id' OR rider_id IS NULL";
        return $this->conn->query($sql);
    }

    public function acceptDelivery($order_id, $rider_id) {
        $sql = "UPDATE deliveries SET status='Accepted', rider_id='$rider_id' WHERE id='$order_id'";
        return $this->conn->query($sql);
    }

    public function updateDeliveryStatus($order_id, $status) {
        $sql = "UPDATE deliveries SET status='$status' WHERE id='$order_id'";
        return $this->conn->query($sql);
    }

    public function getRiderById($rider_id) {
        $sql = "SELECT * FROM riders WHERE id='$rider_id'";
        return $this->conn->query($sql);
    }

    public function updateProfile($rider_id, $username, $phone) {
        $sql = "UPDATE riders SET username='$username', phone='$phone' WHERE id='$rider_id'";
        return $this->conn->query($sql);
    }

    public function updatePassword($rider_id, $new_pass) {
        $sql = "UPDATE riders SET password='$new_pass' WHERE id='$rider_id'";
        return $this->conn->query($sql);
    }

    public function deleteAccount($rider_id) {
        $sql = "DELETE FROM riders WHERE id='$rider_id'";
        return $this->conn->query($sql);
    }
}
?>