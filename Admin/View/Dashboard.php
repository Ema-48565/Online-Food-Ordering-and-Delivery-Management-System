<!DOCTYPE html>

<html>

<head>

    <title>Admin Dashboard</title>

</head>

<body>

    <h2>Admin Dashboard</h2>

    <p>Welcome, Admin!</p>

    <a href="../Controller/dashboard_check.php">Dashboard</a> |

    <a href="../Controller/users_controller.php">Users</a> |

    <a href="../Controller/restaurants_controller.php">Restaurants</a> |

    <a href="../Controller/order_controller.php">Orders</a> |

    <a href="../Controller/logout_controller.php">Logout</a>

    <hr>

    <h3>Dashboard Statistics</h3>

    <table border="1" cellpadding="10">

        <tr>

            <th>Total Users</th>

            <th>Total Restaurants</th>

            <th>Total Orders</th>

            <th>Total Revenue</th>

        </tr>

        <tr>

            <td><?php echo $total_users; ?></td>

            <td><?php echo $total_restaurants; ?></td>

            <td><?php echo $total_orders; ?></td>

            <td><?php echo $total_revenue; ?> BDT</td>

        </tr>

    </table>

</body>

</html>