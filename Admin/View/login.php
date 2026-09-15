<?php
session_start();
if(isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
</head>

<body>

    <h2>Admin Login</h2>

    <form action="../Controller/login_validation.php" method="post">

        <fieldset>

            <legend>Login</legend>

            <table>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter username" />

                        <?php
                        if (isset($_SESSION["usernameError"])) {
                            echo "<br><span style='color:red;'>" . $_SESSION["usernameError"] . "</span>";
                            unset($_SESSION["usernameError"]);
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter password" />

                        <?php
                        if (isset($_SESSION["passwordError"])) {
                            echo "<br><span style='color:red;'>" . $_SESSION["passwordError"] . "</span>";
                            unset($_SESSION["passwordError"]);
                        }
                        ?>
                    </td>
                </tr>

            </table>

            <?php
            if (isset($_SESSION["loginError"])) {
                echo "<span style='color:red;'>" . $_SESSION["loginError"] . "</span>";
                unset($_SESSION["loginError"]);
            }
            ?>

            <br><br>

            <input type="submit" value="Login" />

        </fieldset>

    </form>

</body>

</html>