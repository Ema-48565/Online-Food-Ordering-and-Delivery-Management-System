<?php
session_start();
include('../Model/DatabaseConnection.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div>
        <h2>Welcome, <?php echo $_SESSION['rider_username']; ?> (Delivery Rider)</h2>
        <p>
            <a href="dashboard.php">Dashboard</a> | 
            <a href="profile.php">Profile</a> | 
            <a href="../Controller/logout.php">Logout</a>
        </p>

        <h3>Deliveries List</h3>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            $db = new DatabaseConnection();
            $conn = $db->openConnection();

            $result = $db->getDeliveries($conn, $rider_id);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>#" . $row['id'] . "</td>";
                    echo "<td>" . $row['customer_name'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>";
                    if ($row['rider_id'] == NULL) {
                        echo "<a href='../Controller/acceptDelivery.php?order_id=" . $row['id'] . "'>Accept</a>";
                    } else {
                        echo "<form action='../Controller/updateStatus.php' method='POST'>";
                        echo "<input type='hidden' name='order_id' value='" . $row['id'] . "'>";
                        echo "<select name='status'>";
                        
                        $current_status = $row['status'];
                        $statuses = ['Picked Up', 'On the Way', 'Delivered'];
                        
                        foreach ($statuses as $s) {
                            $selected = ($current_status == $s) ? "selected" : "";
                            echo "<option value='$s' $selected>$s</option>";
                        }
                        
                        echo "</select> ";
                        echo "<button type='submit' name='update_status'>Update</button>";
                        echo "</form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No deliveries found.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>