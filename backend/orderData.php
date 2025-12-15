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

// Fetch order data from the database
$sql = "SELECT order_id, user_name, user_email, user_phone, shipping_address, product_code, product_name, price_per_unit, quantity, subtotal_price FROM orders";
$result = $conn->query($sql);

// Generate rows dynamically
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["user_email"] . "</td>";
        echo "<td>" . $row["user_phone"] . "</td>";
        echo "<td>" . $row["shipping_address"] . "</td>";
        echo "<td>" . $row["product_code"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . number_format($row["price_per_unit"], 2) . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . number_format($row["subtotal_price"], 2) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No orders found</td></tr>";
}

$conn->close();
?>