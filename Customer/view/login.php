<?php
session_start();

if (!empty($_SESSION["isLoggedIn"])) {
    Header("Location: customer_home.php");
    exit();
}

$usernameError = $_SESSION["usernameError"] ?? "";
$passwordError = $_SESSION["passwordError"] ?? "";
$username = $_SESSION["username"] ?? "";
$loginMessage = $_SESSION["loginFailMessage"] ?? "";

unset($_SESSION["usernameError"]);
unset($_SESSION["passwordError"]);
unset($_SESSION["username"]);
unset($_SESSION["loginFailMessage"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="style_2.css">
</head>
<body>
<div class="auth-box">
    <h2>Customer Login</h2>
    <form action="../controller/loginvalidation.php" method="post">
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
        <span class="error-text"><?php echo $loginMessage; ?></span>
        <button type="submit" class="btn-primary" style="width:100%;margin-top:10px;">Login</button>
    </form>
    <div class="switch-link">Don't have an account? <a href="registration.php">Register</a></div>
</div>
</body>
</html>