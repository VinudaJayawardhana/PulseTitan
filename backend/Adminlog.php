<?php
session_start();

// Hardcoded admin credentials
$adminUsername = "admin";
$adminPassword = "admin123"; // Optional: use password_hash() for extra security

//Check whether form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_username = trim($_POST['userName']);
    $input_password = $_POST['password'];
//Check whether there is an exmpty username or password entered 
    if (empty($input_username) || empty($input_password)) {
        echo "<script>alert('Please enter both username and password.'); window.location.href='login.html';</script>";
        exit();
    }
    //Validate whether entered username and password match with login credintials

    if ($input_username === $adminUsername && $input_password === $adminPassword) {
        $_SESSION['username'] = $adminUsername;
        header("Location: adminPanel.php");
        exit();
    } else {
        echo "<script>alert('Incorrect username or password.'); window.location.href='login.html';</script>";
        exit();
    }
}
?>