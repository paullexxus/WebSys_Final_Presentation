<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db = 'signup';
$user = 'root';
$pass = '';

$message = "";
$redirect_url = "loginForm.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // ✅ Secure password validation
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[\W_]/', $password)
        ) {
            $message = "Password must include uppercase, lowercase, number, and special character.";
            $redirect_url = "signForm.html";
        } else {
            // ✅ Hash password correctly
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ✅ Insert to DB
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':username' => $username, ':password' => $hashedPassword]);

            $message = "Signup successful!";
            $redirect_url = "loginForm.php";
        }

    } else {
        $message = "Invalid input.";
        $redirect_url = "signForm.html";
    }

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        $message = "Username already exists.";
    } else {
        $message = "Database error: " . $e->getMessage();
    }
    $redirect_url = "signForm.html";
}

// 🧠 Alert + Redirect
echo "<script>
    alert('$message');
    window.location.href = '$redirect_url';
</script>";
exit();
?>
