<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Orders</title>
</head>

<body>

    <h2>Welcome, Admin!</h2>

   <a href="../Controller/dashboard_check.php">Dashboard</a> |
    <a href="users.php">Users</a> |
    <a href="restaurants.php">Restaurants</a> |
    <a href="orders.php">Orders</a> |
    <a href="../Controller/logout.php">Logout</a>

    <hr/>

    <h3>Manage Orders</h3>

    <form action="../Controller/order_controller.php" method="GET">

        <label>Search Order:</label>

        <input type="text" name="search"
               placeholder="Enter Order ID">

        <button type="submit">Search</button>

    </form>

    <br/>

    <table border="1" cellpadding="8">

        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Restaurant</th>
            <th>Rider</th>
            <th>Order Date</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>101</td>
            <td>Rahim</td>
            <td>ABC Restaurant</td>
            <td>Karim</td>
            <td>13-09-2026</td>
            <td>550 BDT</td>
            <td>Pending</td>
            <td>
                <a href="view_order.php?id=101">View</a>
            </td>
        </tr>

        <tr>
            <td>102</td>
            <td>Sumaiya</td>
            <td>Food Corner</td>
            <td>Hasan</td>
            <td>13-09-2026</td>
            <td>750 BDT</td>
            <td>Preparing</td>
            <td>
                <a href="view_order.php?id=102">View</a>
            </td>
        </tr>

        <tr>
            <td>103</td>
            <td>Nusrat</td>
            <td>Pizza House</td>
            <td>Rahim</td>
            <td>13-09-2026</td>
            <td>900 BDT</td>
            <td>Out for Delivery</td>
            <td>
                <a href="view_order.php?id=103">View</a>
            </td>
        </tr>

        <tr>
            <td>104</td>
            <td>Tanvir</td>
            <td>Spicy Kitchen</td>
            <td>Karim</td>
            <td>13-09-2026</td>
            <td>450 BDT</td>
            <td>Delivered</td>
            <td>
                <a href="view_order.php?id=104">View</a>
            </td>
        </tr>

        <tr>
            <td>105</td>
            <td>Fahim</td>
            <td>Royal Food</td>
            <td>Hasan</td>
            <td>13-09-2026</td>
            <td>650 BDT</td>
            <td>Cancelled</td>
            <td>
                <a href="view_order.php?id=105">View</a>
            </td>
        </tr>

    </table>

</body>

</html>

