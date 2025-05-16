<?php
    session_start(); // Start the session
    if (isset($_SESSION['username'])) {
        header("Location: homepage.php"); // Redirect to the dashboard after successful login
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"><!-- Link to the new CSS file -->
    <title>SDG4: Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <!-- Ensure the 'action' attribute points to your server-side login script (e.g., login.php) -->
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>

            <!-- Optional: Remember Me checkbox for login -->
            <div class="remember-me">
                <input type="checkbox" id="remember_me" name="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>

            <button type="submit">Login</button>
            <p>Don't have an account? | <a href="signupForm.php"> Sign up here</a></p> <!-- Link back to signup page -->
        </form>
    </div>
</body>
</html>
