<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Registration</title>
</head>
<body>
    <h2>Delivery Rider Registration</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Registration</legend>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Choose a username" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password" /></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" name="phone" placeholder="Enter phone number" /></td>
                </tr>
                <tr>
                    <td>NID / Document:</td>
                    <td><input type="file" name="fileupload" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Register" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br/>
    <a href="login.php">Back to Login</a>
</body>
</html>