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
    <a href="../Controller/users_controller.php">Users</a> |
    <a href="../Controller/restaurants_controller.php">Restaurants</a> |
    <a href="../Controller/order_controller.php">Orders</a> |
    <a href="../Controller/logout_controller.php">Logout</a>

    <hr/>

    <h3>All Users</h3>

    <form method="GET" action="../Controller/users_controller.php">

        <input type="text" name="search" placeholder="Search by name or email">

        <button type="submit">Search</button>

    </form>

    <br>

    <table border="1" cellpadding="8">

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

        <?php while ($user = mysqli_fetch_assoc($users)) { ?>

        <tr>

            <td><?php echo $user["id"]; ?></td>

            <td><?php echo $user["name"]; ?></td>

            <td><?php echo $user["email"]; ?></td>

            <td><?php echo $user["role"]; ?></td>

            <td><?php echo $user["status"]; ?></td>

            <td>

                <?php if ($user["status"] == "Active") { ?>

                    <a href="../Controller/users_controller.php?action=block&id=<?php echo $user["id"]; ?>">
                        Block
                    </a>

                <?php } else { ?>

                    <a href="../Controller/users_controller.php?action=unblock&id=<?php echo $user["id"]; ?>">
                        Unblock
                    </a>

                <?php } ?>

            </td>

        </tr>

        <?php } ?>

    </table>

</body>

</html>

