<?php
session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] != true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a> | 
        <a href="../Controller/users_controller.php">Users</a> | 
        <a href="restaurants.php">Restaurants</a> | 
        <a href="orders.php">Orders</a> | 
        <a href="../Controller/logout.php">Logout</a>
    </nav>
    <hr>
    <h3>Dashboard Overview</h3>
    <table border="1" cellpadding="10">
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
</body>
</html>