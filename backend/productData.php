<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pulsetitandb"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product data from the database
$sql = "SELECT product_id, product_name, product_image, product_price, product_rating, product_link, product_category FROM products";
$result = $conn->query($sql);

// Generate rows dynamically
//
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td><img src='" . $row["product_image"] . "' width='50' height='50' alt='" . $row["product_name"] . "'></td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>LKR " . number_format($row["product_price"], 2) . "</td>";
        echo "<td>" . $row["product_rating"] . " </td>";
        echo "<td><a href='" . $row["product_link"] . "' target='_blank'>View Product</a></td>";
        echo "<td>" . $row["product_category"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No products found</td></tr>";
}

$conn->close();
?>