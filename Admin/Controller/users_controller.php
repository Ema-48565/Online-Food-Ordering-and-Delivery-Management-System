<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

require_once "../Model/user_model.php";

$users = getUsers();

include "../View/users.php";

?>

