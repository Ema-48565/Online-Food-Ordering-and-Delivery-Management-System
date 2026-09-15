<?php
require_once "../../DatabaseConnection.php";
require_once "../Model/ManagerModel.php";

$database = new DatabaseConnection();
$conn = $database->openConnection();
$model = new ManagerModel($conn);

$message = "";

if (isset($_POST['add_food'])) {
    $name = trim($_POST['food_name']);
    $category = trim($_POST['category']);
    $price = (float)$_POST['price'];
    $status = $_POST['status'];

    if ($name !== "" && $category !== "" && $price >= 0) {
        $model->addFood($name, $category, $price, $status);
        header("Location: FoodController.php?msg=added");
        exit;
    }
}

if (isset($_GET['delete'])) {
    $model->deleteFood((int)$_GET['delete']);
    header("Location: FoodController.php?msg=deleted");
    exit;
}

if (isset($_POST['update_food'])) {
    $model->updateFood((int)$_POST['id'], trim($_POST['food_name']), trim($_POST['category']), (float)$_POST['price'], $_POST['status']);
    header("Location: FoodController.php?msg=updated");
    exit;
}

if (isset($_GET['msg'])) {
    $message = ucfirst($_GET['msg']) . " successfully.";
}

$editFood = null;
if (isset($_GET['edit'])) {
    $editFood = $model->getFoodById((int)$_GET['edit']);
}

$foods = $model->getAllFoods();

include "../View/food.php";
?>