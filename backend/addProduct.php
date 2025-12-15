<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $product_name = $_POST['product_name'];
    $product_price = floatval($_POST['product_price']);
    $product_rating = floatval($_POST['product_rating']);
    $product_link = $_POST['product_link'];
    $product_category = $_POST['product_category'];

    // File upload handling
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    $target_file = $upload_dir . basename($_FILES["product_image"]["name"]);

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // Insert product into database
        //Here prepare statement is a secure way of making sql query statements
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_image, product_price, product_rating, product_link, product_category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sddsss", $product_name, $target_file, $product_price, $product_rating, $product_link, $product_category);
        echo $stmt->execute() ? " Product added successfully!" : " Error: " . $stmt->error;
        $stmt->close();
    } else {
        echo " Failed to upload the image.";
    }
}

$conn->close();
?>