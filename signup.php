<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pulsetitandb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data 
//$real escape string is used to get a clean input and avoid bad input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['firstName']);
    $last_name = $conn->real_escape_string($_POST['lastName']);
    $username = $conn->real_escape_string($_POST['userName']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phoneNumber']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Check if email exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $sql = "INSERT INTO users (firstName, lastName, userName, email, phoneNumber, dob, gender, password) 
            VALUES ('$first_name', '$last_name', '$username', '$email', '$phone', '$dob', '$gender', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit(); // Stop execution after redirect
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>



