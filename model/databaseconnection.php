<?php
class DatabaseConnection
{

    function openConnection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "delivery_db"; // shared database (riders + deliveries table ekhane)

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($connection->connect_error) {
            die("Can not connect to the database, please try again. " . $connection->connect_error);
        }
        return $connection;
    }


    function signup($connection, $username, $password, $phone, $file_path)
    {
        $sql = "INSERT INTO customers (username, password, phone, file_path) VALUES('" . $username . "', '" . $password . "', '" . $phone . "', '" . $file_path . "')";
        return $connection->query($sql);
    }

    function signin($connection, $username, $password)
    {
        $sql = "SELECT * FROM customers WHERE username='" . $username . "' AND password ='" . $password . "'";
        return $connection->query($sql);
    }


    function placeOrder($connection, $customer_name, $address, $amount)
    {
        $sql = "INSERT INTO deliveries (customer_name, address, amount, status, rider_id)
                VALUES ('$customer_name', '$address', '$amount', 'Pending', NULL)";
        $result = $connection->query($sql);
        if ($result) {
            return $connection->insert_id;
        }
        return false;
    }

    function getOrderStatus($connection, $order_id)
    {
        $order_id = (int)$order_id;
        $sql = "SELECT * FROM deliveries WHERE id = $order_id";
        $result = $connection->query($sql);
        return $result->fetch_assoc();
    }

    function getOrdersByCustomer($connection, $customer_name)
    {
        $customer_name = $connection->real_escape_string($customer_name);
        $sql = "SELECT * FROM deliveries WHERE customer_name = '$customer_name' ORDER BY id DESC";
        return $connection->query($sql);
    }
}
?>