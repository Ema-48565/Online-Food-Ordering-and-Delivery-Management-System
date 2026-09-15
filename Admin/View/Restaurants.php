<!DOCTYPE html>

<html>

<head>

    <title>Manage Restaurants</title>

</head>

<body>

    <h2>Manage Restaurants</h2>

    <p>Welcome, Admin!</p>

    <a href="../Controller/dashboard_check.php">Dashboard</a> |
    <a href="../Controller/users_controller.php">Users</a> |
    <a href="../Controller/restaurants_controller.php">Restaurants</a> |
    <a href="../Controller/order_controller.php">Orders</a> |
    <a href="../Controller/logout_controller.php">Logout</a>

    <hr>

    <h3>All Restaurants</h3>

    <form method="GET" action="../Controller/restaurants_controller.php">

        <input type="text" name="search" placeholder="Search restaurant">

        <button type="submit">Search</button>

    </form>

    <br>

    <a href="../View/add_Restaurants.php">Add New Restaurant</a>

    <br><br>

    <table border="1" cellpadding="8">

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Location</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

        <?php while ($restaurant = mysqli_fetch_assoc($restaurants)) { ?>

        <tr>

            <td><?php echo $restaurant["id"]; ?></td>

            <td><?php echo $restaurant["name"]; ?></td>

            <td><?php echo $restaurant["owner"]; ?></td>

            <td><?php echo $restaurant["location"]; ?></td>

            <td><?php echo $restaurant["contact"]; ?></td>

            <td><?php echo $restaurant["status"]; ?></td>

            <td>

                <a href="../View/edit_Restaurants.php?id=<?php echo $restaurant["id"]; ?>">
                    Edit
                </a>

                |

                <?php if ($restaurant["status"] == "Active") { ?>

                    <a href="../Controller/restaurants_controller.php?action=block&id=<?php echo $restaurant["id"]; ?>">
                        Block
                    </a>

                <?php } else { ?>

                    <a href="../Controller/restaurants_controller.php?action=unblock&id=<?php echo $restaurant["id"]; ?>">
                        Unblock
                    </a>

                <?php } ?>

            </td>

        </tr>

        <?php } ?>

    </table>

</body>

</html>