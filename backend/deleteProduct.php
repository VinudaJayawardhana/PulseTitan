<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validate input
    $product_id = intval($_POST['product_id']);  // Use 'product_id' instead of 'delete_id'

    // Retrieve product image path before deletion
    $image_query = $conn->prepare("SELECT product_image FROM products WHERE product_id = ?");
    $image_query->bind_param("i", $product_id);
    $image_query->execute();
    $image_result = $image_query->get_result();

    if ($image_result->num_rows > 0) {
        $image_row = $image_result->fetch_assoc();
        $image_path = $image_row['product_image'];

        // Delete product from database
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            // Remove the image file from the server if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            echo "<script>alert('Product deleted successfully!'); window.location='product_section.html';</script>";
        } else {
            echo "<script>alert('Error deleting product: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Product not found!');</script>";
    }
}

$conn->close();
?>