<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>
    <h2>Rider Profile & Account Management</h2>
    <a href="dashboard.php">Assigned Orders</a> | 
    <a href="history.php">Delivery History</a> | 
    <a href="profile.php">My Profile</a> | 
    <a href="../Controller/logout.php">Logout</a>
    <hr/>

    <?php if(!empty($_SESSION["msg"])) { echo "<p style='color:green;'><b>".$_SESSION["msg"]."</b></p>"; unset($_SESSION["msg"]); } ?>

    <h3>Profile Information</h3>
    <form action="../Controller/updateProfile.php" method="post">
        <table>
            <tr>
                <td>Username:</td>
                <td><b>rider_demo</b></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?? '01700000000'; ?>" /></td>
            </tr>
            <tr>
                <td>Uploaded File:</td>
                <td>nid_doc.pdf</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Update Profile" /></td>
            </tr>
        </table>
    </form>

    <hr/>
    <h3>Change Password</h3>
    <form action="../Controller/changePassword.php" method="post">
        <table>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="new_password" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Update Password" /></td>
            </tr>
        </table>
    </form>

    <hr/>
    <h3>Delete Account</h3>
    <form action="../Controller/deleteAccount.php" method="post">
        <input type="submit" value="Delete My Account" style="color:red;" />
    </form>
</body>
</html>