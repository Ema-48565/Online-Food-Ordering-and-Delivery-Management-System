<?php
?>

<!DOCTYPE html>

<html>

<head>
    <title>Manage Users</title>
</head>

<body>

    <h2>Manage Users</h2>

    <p>Welcome, Admin!</p>

    <a href="../Controller/dashboard_check.php">Dashboard</a> |
   <a href="../Controller/user_controller.php">Users</a>
    <a href="restaurants.php">Restaurants</a> |
    <a href="orders.php">Orders</a> |
    <a href="../Controller/logout.php">Logout</a>

    <hr/>

    <h3>All Users</h3>

    <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
        </tr>

        <?php while ($user = mysqli_fetch_assoc($users)) { ?>

        <tr>
            <td><?php echo $user["id"]; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><?php echo $user["email"]; ?></td>
            <td><?php echo $user["role"]; ?></td>
            <td><?php echo $user["status"]; ?></td>
        </tr>

        <?php } ?>

    </table>

</body>

</html>