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
        $stmt = $this->conn->prepare("SELECT * FROM riders WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function registerRider($username, $password, $phone, $file_path) {
        $stmt = $this->conn->prepare("INSERT INTO riders (username, password, phone, file_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $phone, $file_path);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function loginRider($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM riders WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getDeliveries($rider_id) {
        $stmt = $this->conn->prepare("SELECT * FROM deliveries WHERE rider_id = ? OR rider_id IS NULL");
        $stmt->bind_param("i", $rider_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function acceptDelivery($order_id, $rider_id) {
        $stmt = $this->conn->prepare("UPDATE deliveries SET status = 'Accepted', rider_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $rider_id, $order_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateDeliveryStatus($order_id, $status) {
        $stmt = $this->conn->prepare("UPDATE deliveries SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $order_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getRiderById($rider_id) {
        $stmt = $this->conn->prepare("SELECT * FROM riders WHERE id = ?");
        $stmt->bind_param("i", $rider_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateProfile($rider_id, $username, $phone) {
        $stmt = $this->conn->prepare("UPDATE riders SET username = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $phone, $rider_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePassword($rider_id, $new_pass) {
        $stmt = $this->conn->prepare("UPDATE riders SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_pass, $rider_id);
        $result->execute();
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteAccount($rider_id) {
        $stmt = $this->conn->prepare("DELETE FROM riders WHERE id = ?");
        $stmt->bind_param("i", $rider_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>