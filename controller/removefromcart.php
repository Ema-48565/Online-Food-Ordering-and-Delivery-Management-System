<?php
session_start();

$food_id = $_GET["food_id"];
unset($_SESSION["cart"][$food_id]);

Header("Location: ../View/food_details_cart.php");
?>