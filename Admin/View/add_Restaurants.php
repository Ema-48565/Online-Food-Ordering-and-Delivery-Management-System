<!DOCTYPE html>

<html>

<head>

    <title>Add Restaurant</title>

</head>

<body>

    <h2>Add New Restaurant</h2>

    <form method="POST" action="../Controller/restaurants_controller.php">

        <input type="hidden" name="action" value="add">

        Name:
        <input type="text" name="name" required>

        <br><br>

        Owner:
        <input type="text" name="owner" required>

        <br><br>

        Location:
        <input type="text" name="location" required>

        <br><br>

        Contact:
        <input type="text" name="contact" required>

        <br><br>

        Status:

        <select name="status">

            <option value="Active">Active</option>
            <option value="Blocked">Blocked</option>

        </select>

        <br><br>

        <button type="submit">Add Restaurant</button>

    </form>

    <br>

    <a href="../Controller/restaurants_controller.php">
        Back to Restaurants
    </a>

</body>

</html>