<?php
include_once("../../DatabaseConnection.php");
include_once("../Model/CustomerModel.php");
include_once("../Model/foodmenu.php");
session_start();

$address = $_POST["address"] ?? "";
$customer_name = $_SESSION["loggedInUsername"] ?? ($_POST["name"] ?? "Guest");

$menu = new FoodMenu();
$amount = 0;

if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $food_id => $qty) {
        $food = $menu->getFoodById($food_id);
        if ($food) {
            $amount += $food["price"] * $qty;
        }
    }
}

if ($amount == 0) {
    $_SESSION["checkoutError"] = "Your cart is empty";
    Header("Location: ../View/checkout.php");
    exit();
}

$database = new DatabaseConnection();
$connection = $database->openConnection();
$customerModel = new CustomerModel();

$order_id = $customerModel->placeOrder($connection, $customer_name, $address, $amount);

if ($order_id) {
    unset($_SESSION["cart"]);
    Header("Location: ../View/order_status.php?order_id=" . $order_id);
} else {
    echo "Failed to place order";
}
exit();
?>