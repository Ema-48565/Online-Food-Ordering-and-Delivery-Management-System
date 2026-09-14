<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>

    <h2>Welcome, Admin!</h2>

    <a href="../Controller/dashboard_check.php">Dashboard</a> |
    <a href="../Controller/users_controller.php">Users</a>|
    <a href="restaurants.php">Restaurants</a> |
    <a href="orders.php">Orders</a> |
    <a href="../Controller/logout.php">Logout</a>

    <hr/>

    <h3>Dashboard Overview</h3>

    <table border="1" cellpadding="8">

        <tr>
            <th>Total Users</th>
            <th>Restaurants</th>
            <th>Total Orders</th>
            <th>Total Revenue</th>
        </tr>

        <tr>
            <td>120</td>
            <td>15</td>
            <td>350</td>
            <td>52,000</td>
        </tr>

    </table>

    <br/>

    <h3>Recent Orders</h3>

    <table border="1" cellpadding="8">

        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Restaurant</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>

        <tr>
            <td>101</td>
            <td>Rahim Uddin</td>
            <td>ABC Restaurant</td>
            <td>500 BDT</td>
            <td>Pending</td>
        </tr>

        <tr>
            <td>102</td>
            <td>Karim Chowdhury</td>
            <td>Food Corner</td>
            <td>750 BDT</td>
            <td>Completed</td>
        </tr>

        <tr>
            <td>103</td>
            <td>Sarah Ahmed</td>
            <td>Pizza House</td>
            <td>650 BDT</td>
            <td>Pending</td>
        </tr>

    </table>

</body>

</html>