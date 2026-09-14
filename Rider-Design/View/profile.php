<?php
session_start();
include_once('../Model/RiderModel.php');

if (!isset($_SESSION['rider_id'])) {
    header("Location: login.php");
    exit();
}

$rider_id = $_SESSION['rider_id'];


$riderModel = new RiderModel();
$result = $riderModel->getRiderById($rider_id);
$rider = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rider Profile</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        input {
            width: 250px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Manage Profile</h2>
        <p><a href="dashboard.php">Back to Dashboard</a> | <a href="../Controller/logout.php">Logout</a></p>

        <?php 
        if(isset($_GET['success'])) { echo "<p style='color:green;'>".$_GET['success']."</p>"; }
        if(isset($_GET['error'])) { echo "<p style='color:red;'>".$_GET['error']."</p>"; }
        ?>

        <form action="../Controller/updateProfile.php" method="POST">
            <label>Username:</label><br>
            <input type="text" name="username" value="<?php echo $rider['username']; ?>" required><br><br>
            
            <label>Phone:</label><br>
            <input type="text" name="phone" value="<?php echo $rider['phone']; ?>" required><br><br>
            
            <button type="submit" name="update">Update Profile</button>
        </form>

        <hr>

        <h3>Change Password</h3>
        <form action="../Controller/changePassword.php" method="POST">
            <label>Old Password:</label><br>
            <input type="password" name="old_password" required><br><br>
            <label>New Password:</label><br>
            <input type="password" name="new_password" required><br><br>
            <button type="submit" name="change_pass">Change Password</button>
        </form>

        <hr>

        <h3>Delete Account</h3>
        <form action="../Controller/deleteAccount.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button type="submit" style="color: red;">Delete My Account</button>
        </form>
    </div>
</body>
</html>