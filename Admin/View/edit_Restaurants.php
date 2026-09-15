<?php

require_once "../Model/restaurants_model.php";

if (!isset($_GET["id"])) {
    header("Location: ../Controller/restaurants_controller.php");
    exit();
}

$id = $_GET["id"];

$restaurant = getRestaurant($id);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Edit Restaurant</title>

</head>

<body>

    <h2>Edit Restaurant</h2>

    <form method="POST" action="../Controller/restaurants_controller.php">

        <input type="hidden" name="action" value="edit">

        <input type="hidden" name="id" value="<?php echo $restaurant["id"]; ?>">

        Name:
        <input type="text" name="name"
        value="<?php echo $restaurant["name"]; ?>" required>

        <br><br>

        Owner:
        <input type="text" name="owner"
        value="<?php echo $restaurant["owner"]; ?>" required>

        <br><br>

        Location:
        <input type="text" name="location"
        value="<?php echo $restaurant["location"]; ?>" required>

        <br><br>

        Contact:
        <input type="text" name="contact"
        value="<?php echo $restaurant["contact"]; ?>" required>

        <br><br>

        Status:

        <select name="status">

            <option value="Active"
            <?php if ($restaurant["status"] == "Active") echo "selected"; ?>>
                Active
            </option>

            <option value="Blocked"
            <?php if ($restaurant["status"] == "Blocked") echo "selected"; ?>>
                Blocked
            </option>

        </select>

        <br><br>

        <button type="submit">Update Restaurant</button>

    </form>

    <br>

    <a href="../Controller/restaurants_controller.php">
        Back to Restaurants
    </a>

</body>

</html>