<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_rating = $_POST['product_rating'];
    $product_link = $_POST['product_link'];
    $product_category = $_POST['product_category'];
    
    // Check if a new image is uploaded
    if (!empty($_FILES["product_image"]["name"])) {
        $image_path = "uploads/" . basename($_FILES["product_image"]["name"]);
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_path)) {
            // Get the current image path before updating
            $image_query = $conn->prepare("SELECT product_image FROM products WHERE product_id = ?");
            $image_query->bind_param("i", $product_id);
            $image_query->execute();
            $image_result = $image_query->get_result();

            if ($image_result->num_rows > 0) {
                $image_row = $image_result->fetch_assoc();
                $old_image_path = $image_row['product_image'];

                // Delete the old image file from server
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            // Update product data including the new image
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_price = ?, product_rating = ?, product_link = ?, product_category = ?, product_image = ? WHERE product_id = ?");
            $stmt->bind_param("ssssssi", $product_name, $product_price, $product_rating, $product_link, $product_category, $image_path, $product_id);
        } else {
            echo "<script>alert('Error uploading new image.');</script>";
            exit;
        }
    } else {
        // Update without changing the image
        $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_price = ?, product_rating = ?, product_link = ?, product_category = ? WHERE product_id = ?");
        $stmt->bind_param("sssssi", $product_name, $product_price, $product_rating, $product_link, $product_category, $product_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully!'); window.location='product_section.html';</script>";
    } else {
        echo "<script>alert('Error updating product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>