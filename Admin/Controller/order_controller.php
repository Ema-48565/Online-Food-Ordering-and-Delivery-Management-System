<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

require_once "../Model/order_model.php";

if (isset($_GET["search"])) {

    $search = $_GET["search"];

    $orders = searchOrders($search);

} else {

    $orders = getOrders();

}

include "../View/orders.php";

?>