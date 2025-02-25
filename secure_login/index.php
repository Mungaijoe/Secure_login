
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="authenticate.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            
        </form>
        <div class="text-center">
           <p>Not a member? <a href="register.php">Register</a></p>
        </div>


    </div>
</body>
</html>
