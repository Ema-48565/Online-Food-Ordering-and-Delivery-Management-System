<?php

require_once "../Model/order_model.php";

$id = $_GET["id"];

$order = getOrder($id);

?>

<!DOCTYPE html>

<html>

<head>
    <title>View Order</title>
</head>

<body>

    <h2>Order Details</h2>

    <p>Welcome, Admin!</p>

    <a href="../Controller/dashboard_check.php">Dashboard</a> |
    <a href="../Controller/users_controller.php">Users</a> |
    <a href="../Controller/restaurants_controller.php">Restaurants</a> |
    <a href="../Controller/order_controller.php">Orders</a> |
    <a href="../Controller/logout_controller.php">Logout</a>

    <hr>

    <h3>Order Information</h3>

    <table border="1" cellpadding="8">

        <tr>
            <th>Order ID</th>
            <td><?php echo $order["id"]; ?></td>
        </tr>

        <tr>
            <th>Customer Name</th>
            <td><?php echo $order["customer_name"]; ?></td>
        </tr>

        <tr>
            <th>Restaurant</th>
            <td><?php echo $order["restaurant"]; ?></td>
        </tr>

        <tr>
            <th>Rider</th>
            <td><?php echo $order["rider"]; ?></td>
        </tr>

        <tr>
            <th>Order Date</th>
            <td><?php echo $order["order_date"]; ?></td>
        </tr>

        <tr>
            <th>Total Amount</th>
            <td><?php echo $order["total_amount"]; ?> BDT</td>
        </tr>

        <tr>
            <th>Status</th>
            <td><?php echo $order["status"]; ?></td>
        </tr>

    </table>

    <br>

    <a href="../Controller/order_controller.php">
        Back to Orders
    </a>

</body>

</html>

