<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

$search = $_GET["search"] ?? "";

if ($search != "") {
    $_SESSION["restaurantSearch"] = $search;
} else {
    unset($_SESSION["restaurantSearch"]);
}

header("Location: ../View/restaurants.php");
exit();

?>

