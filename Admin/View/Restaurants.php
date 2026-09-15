<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Restaurants</title>
</head>

<body>

    <h2>Welcome, Admin!</h2>
    <a href="dashboard.php">Dashboard</a> |
    <a href="users.php">Users</a> |
    <a href="restaurants.php">Restaurants</a> |
    <a href="orders.php">Orders</a> |
    <a href="../Controller/logout.php">Logout</a>

    <hr/>

    <h3>Manage Restaurants</h3>
    <form action="../Controller/restaurants_controller.php" method="GET">
        <label>Search Restaurant:</label>
        <input type="text" name="search" placeholder="Enter restaurant name">
        <button type="submit">Search</button>
    </form>

    <br/>
    <a href="add_restaurant.php">Add New Restaurant</a>

    <br/><br/>
    <table border="1" cellpadding="8">

        <tr>
            <th>Restaurant ID</th>
            <th>Restaurant Name</th>
            <th>Owner Name</th>
            <th>Location</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>1</td>
            <td>ABC Restaurant</td>
            <td>Rahim Uddin</td>
            <td>Mirpur, Dhaka</td>
            <td>01700000001</td>
            <td>Active</td>
            <td>
                <a href="edit_restaurant.php?id=1">Edit</a> |
                <button>Block</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Food Corner</td>
            <td>Karim Chowdhury</td>
            <td>Banani, Dhaka</td>
            <td>01700000002</td>
            <td>Active</td>
            <td>
                <a href="edit_restaurant.php?id=2">Edit</a> |
                <button>Block</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Pizza House</td>
            <td>Sarah Ahmed</td>
            <td>Dhanmondi, Dhaka</td>
            <td>01700000003</td>
            <td>Blocked</td>
            <td>
                <a href="edit_restaurant.php?id=3">Edit</a> |
                <button>Unblock</button>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Spicy Kitchen</td>
            <td>Hasan Ali</td>
            <td>Uttara, Dhaka</td>
            <td>01700000004</td>
            <td>Active</td>
            <td>
                <a href="edit_restaurant.php?id=4">Edit</a> |
                <button>Block</button>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Royal Food</td>
            <td>Nusrat Jahan</td>
            <td>Gulshan, Dhaka</td>
            <td>01700000005</td>
            <td>Active</td>
            <td>
                <a href="edit_restaurant.php?id=5">Edit</a> |
                <button>Block</button>
            </td>
        </tr>

    </table>

</body>

</html>