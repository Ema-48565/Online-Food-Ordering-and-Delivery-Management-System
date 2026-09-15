<?php
session_start();
// কন্ট্রোলার বা মডেল থেকে ইউজার ডেটা আনার জন্য রিকোয়েস্ট লিংক করা যেতে পারে
// বর্তমানে ভিউ যেন এরর না দেয় সেভাবে পাথ ঠিক করা হলো
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
</head>

<body>

    <h2>Manage Users</h2>
    <p>Welcome, Admin!</p>

    <a href="dashboard.php">Dashboard</a> |
    <a href="users.php">Users</a> |
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

        <?php 
    
        if (isset($users) && $users) {
            while ($user = mysqli_fetch_assoc($users)) { 
        ?>
        <tr>
            <td><?php echo $user["id"]; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><?php echo $user["email"]; ?></td>
            <td><?php echo $user["role"]; ?></td>
            <td><?php echo $user["status"]; ?></td>
        </tr>
        <?php 
            } 
        } else {
            echo "<tr><td colspan='5'>No users found or controller not connected yet.</td></tr>";
        }
        ?>

    </table>

</body>

</html>