<?php
session_start();

$usernameError = $_SESSION["usernameError"] ?? "";
$passwordError = $_SESSION["passwordError"] ?? "";
$username = $_SESSION["username"] ?? "";

unset($_SESSION["usernameError"]);
unset($_SESSION["passwordError"]);
unset($_SESSION["username"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-box">
    <h2>Customer Registration</h2>
    <form action="../controller/registrationvalidation.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <span class="error-text"><?php echo $usernameError; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
            <span class="error-text"><?php echo $passwordError; ?></span>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone">
        </div>
        <div class="form-group">
            <label>Profile Photo (Optional)</label>
            <input type="file" name="fileupload">
        </div>
        <button type="submit" class="btn-primary" style="width:100%;">Register</button>
    </form>
    <div class="switch-link">Already have an account? <a href="login.php">Login</a></div>
</div>
</body>
</html>