<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Optional: Start session if needed later
session_start();

if (isset($_SESSION['username'])) {
    header("Location: homepage.php");
    exit;
}

$host = 'localhost';
$db = 'sdg4';
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

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Optionally store session data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // ✅ Success
            header("Location: homepage.php");
            exit();
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Please fill in both fields.";
    }

} catch (PDOException $e) {
    $message = "Database error: " . $e->getMessage();
}

// 🧠 Show error and redirect
echo "<script>
    alert('$message');
    window.location.href = 'loginForm.php';
</script>";
exit();
?>
