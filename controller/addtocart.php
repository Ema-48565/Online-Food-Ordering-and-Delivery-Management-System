<?php
session_start();

$food_id = $_POST["food_id"];
$qty = $_POST["qty"] ?? 1;

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (isset($_SESSION["cart"][$food_id])) {
    $_SESSION["cart"][$food_id] += $qty;
} else {
    $_SESSION["cart"][$food_id] = $qty;
}

Header("Location: ../View/food_details_cart.php?id=" . $food_id);
?>