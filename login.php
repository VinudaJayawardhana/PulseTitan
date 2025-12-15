<?php
session_start();

// Show all errors (for debugging - remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DB connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pulsetitandb";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize input
    $input_username = trim($conn->real_escape_string($_POST['userName']));
    $input_password = $_POST['password'];

    if (empty($input_username) || empty($input_password)) {
        echo "<script>alert('Please enter both username and password.'); window.location.href='login.html';</script>";
        exit();
    }

    // Query database for the user
    $sql = "SELECT * FROM users WHERE userName = '$input_username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($input_password, $user['password'])) {
            // Store session data
            $_SESSION['user_id'] = $user['memberID'];
            $_SESSION['username'] = $user['userName'];

            // Redirect to homepage
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password.'); window.location.href='login.html';</script>";
            exit();
        }
    } else {
        // No user found
        echo "<script>alert('No user found with that username.'); window.location.href='login.html';</script>";
        exit();
    }
}

$conn->close();
?>
