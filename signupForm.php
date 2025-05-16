<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> <!-- Siguraduhing mayroon kang signup.css para sa styling -->
    <title>SGD4: Sign Up</title>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <!-- Ensure the 'action' attribute points to your server-side script (e.g., signup.php) -->
        <!-- The form will now submit normally -->
        <form action="signup.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username"><br><br>

            <label for="password">Password</label>
            <!-- Gamitin ang type="password" para hindi makita ang input -->
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>

            <label for="confirm_password">Confirm Password</label>
            <!-- Gamitin ang type="password" at ibang 'id' at 'name' para sa confirm password -->
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br><br>

            <button type="submit">Sign Up</button>
            <p>Already have an account? | <a href="loginForm.php">Login here</a></p> <!-- Assuming login page is loginForm.html -->
        </form>
    </div>

    <!-- Removed the JavaScript block here -->

</body>
</html>
