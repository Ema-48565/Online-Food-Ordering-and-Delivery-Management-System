<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

require_once "../Model/restaurants_model.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"];

    if ($action == "add") {

        $name = $_POST["name"];
        $owner = $_POST["owner"];
        $location = $_POST["location"];
        $contact = $_POST["contact"];
        $status = $_POST["status"];

        addRestaurant($name, $owner, $location, $contact, $status);

        header("Location: restaurants_controller.php");
        exit();

    }

    if ($action == "edit") {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $owner = $_POST["owner"];
        $location = $_POST["location"];
        $contact = $_POST["contact"];
        $status = $_POST["status"];

        updateRestaurant($id, $name, $owner, $location, $contact, $status);

        header("Location: restaurants_controller.php");
        exit();
    }
}

if (isset($_GET["action"]) && isset($_GET["id"])) {

    $id = $_GET["id"];
    $action = $_GET["action"];

    if ($action == "block") {

        blockRestaurant($id);

    } elseif ($action == "unblock") {

        unblockRestaurant($id);
    }

    header("Location: restaurants_controller.php");
    exit();
}

if (isset($_GET["search"])) {

    $search = $_GET["search"];

    $restaurants = searchRestaurants($search);

} else {

    $restaurants = getRestaurants();
}

include "../View/Restaurants.php";

?>