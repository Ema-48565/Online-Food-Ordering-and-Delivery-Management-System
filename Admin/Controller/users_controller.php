<?php

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: ../View/login.php");
    exit();
}

require_once "../Model/user_model.php";

if (isset($_GET["action"]) && isset($_GET["id"])) {

    $id = $_GET["id"];
    $action = $_GET["action"];

    if ($action == "block") {

        blockUser($id);

    } elseif ($action == "unblock") {

        unblockUser($id);

    }

    header("Location: users_controller.php");
    exit();

}

if (isset($_GET["search"])) {

    $search = $_GET["search"];

    $users = searchUsers($search);

} else {

    $users = getUsers();

}

include "../View/users.php";

?>