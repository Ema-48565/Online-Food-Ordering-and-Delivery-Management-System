<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Dashboard</title>
</head>
<body>
    <h2>Welcome, Rider!</h2>
    <a href="dashboard.php">Assigned Orders</a> | 
    <a href="history.php">Delivery History</a> | 
    <a href="profile.php">My Profile</a> | 
    <a href="../Controller/logout.php">Logout</a>
    <hr/>

    <?php 
    if(!empty($_SESSION["msg"])) {
         echo "<p style='color:green;'><b>".$_SESSION["msg"]."</b></p>"; unset($_SESSION["msg"]); } 
         ?>

    <h3>Assigned Orders</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Delivery Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>101</td>
            <td>Rahim Uddin</td>
            <td>House 12, Road 5, Mirpur 10</td>
            <td>Pending</td>
            <td><a href="../Controller/acceptDelivery.php?id=101">Accept Delivery</a></td>
        </tr>
        <tr>
            <td>102</td>
            <td>Karim Chowdhury</td>
            <td>Block C, Banani, Dhaka</td>
            <td>Accepted</td>
            <td><a href="../Controller/updateStatus.php?id=102&status=Picked Up">Mark Picked Up</a></td>
        </tr>
    </table>
</body>
</html>