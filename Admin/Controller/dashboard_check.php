<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

require_once "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();

$conn = $db->openConnection();

$user_result = $conn->query("SELECT COUNT(*) AS total FROM users");
$user_data = mysqli_fetch_assoc($user_result);
$total_users = $user_data["total"];

$restaurant_result = $conn->query("SELECT COUNT(*) AS total FROM restaurants");
$restaurant_data = mysqli_fetch_assoc($restaurant_result);
$total_restaurants = $restaurant_data["total"];

$order_result = $conn->query("SELECT COUNT(*) AS total FROM orders");
$order_data = mysqli_fetch_assoc($order_result);
$total_orders = $order_data["total"];

$revenue_result = $conn->query("SELECT SUM(total_amount) AS total FROM orders");
$revenue_data = mysqli_fetch_assoc($revenue_result);
$total_revenue = $revenue_data["total"];

include "../View/Dashboard.php";

?>