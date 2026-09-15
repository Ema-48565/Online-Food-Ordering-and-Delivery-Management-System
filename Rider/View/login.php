<?php
session_start();
if(isset($_SESSION['rider_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
        <h2>Delivery Rider Login</h2>
        <?php if(isset($_GET['error'])) { echo "<p style='color:red;'>".$_GET['error']."</p>"; } ?>
        <?php if(isset($_GET['success'])) { echo "<p style='color:green;'>".$_GET['success']."</p>"; } ?>
        <form action="../Controller/loginValidation.php" method="POST">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</body>
</html>