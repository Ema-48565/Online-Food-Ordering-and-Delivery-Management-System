<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Login</title>
</head>
<body>
    <h2>Delivery Rider Login</h2>
    <form action="../Controller/loginValidation.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter username" /></td>
                    <td><span style="color:red;"><?php echo $_SESSION["usernameError"] ?? ""; unset($_SESSION["usernameError"]); ?></span></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password" /></td>
                    <td><span style="color:red;"><?php echo $_SESSION["passwordError"] ?? ""; unset($_SESSION["passwordError"]); ?></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br/>
    <a href="registration.php">New Rider? Register here</a>
</body>
</html>