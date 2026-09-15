<!DOCTYPE html>
<html>
<head>
    <title>Delivery Rider Registration</title>
    <script src="../Controller/JS/checkUsername.js"></script>
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
        <h2>Delivery Rider Registration</h2>
        <?php if(isset($_GET['error'])) { echo "<p style='color:red;'>".$_GET['error']."</p>"; } ?>
        
        <form action="../Controller/regValidation.php" method="POST" enctype="multipart/form-data">
            <label>Username:</label><br>
            <input type="text" id="username" name="username" onkeyup="checkUsernameAvailability()" required>
            <span id="usernameMsg"></span><br><br>
            
            <label>Phone:</label><br>
            <input type="text" name="phone" required><br><br>
            
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            
            <label>Upload Document/Image:</label><br>
            <input type="file" name="file"><br><br>
            
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>