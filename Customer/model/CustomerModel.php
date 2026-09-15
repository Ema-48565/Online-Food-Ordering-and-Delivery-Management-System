<?php
include_once("../../DatabaseConnection.php");

class CustomerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
    }

    public function signup($connection, $username, $password, $phone, $file_path)
    {
        $sql = "INSERT INTO customers (username, password, phone, file_path) VALUES('" . $username . "', '" . $password . "', '" . $phone . "', '" . $file_path . "')";
        return $connection->query($sql);
    }

    public function signin($connection, $username, $password)
    {
        $sql = "SELECT * FROM customers WHERE username='" . $username . "' AND password ='" . $password . "'";
        return $connection->query($sql);
    }

    public function placeOrder($connection, $customer_name, $address, $amount)
    {
        $sql = "INSERT INTO deliveries (customer_name, address, amount, status, rider_id)
                VALUES ('$customer_name', '$address', '$amount', 'Pending', NULL)";
        $result = $connection->query($sql);
        if ($result) {
            return $connection->insert_id;
        }
        return false;
    }

    public function getOrderStatus($connection, $order_id)
    {
        $order_id = (int)$order_id;
        $sql = "SELECT * FROM deliveries WHERE id = $order_id";
        $result = $connection->query($sql);
        return $result->fetch_assoc();
    }

    public function getOrdersByCustomer($connection, $customer_name)
    {
        $customer_name = $connection->real_escape_string($customer_name);
        $sql = "SELECT * FROM deliveries WHERE customer_name = '$customer_name' ORDER BY id DESC";
        return $connection->query($sql);
    }
}
?>