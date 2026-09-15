<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

$search = $_GET["search"] ?? "";

if ($search != "") {
    $_SESSION["orderSearch"] = $search;
} else {
    unset($_SESSION["orderSearch"]);
}

header("Location: ../View/orders.php");
exit();