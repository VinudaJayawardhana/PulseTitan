<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve products from the database
$result = $conn->query("SELECT * FROM products where product_id>24 ORDER BY product_id DESC"); // Fetch newest products first

if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product product-card">';
        echo '<div class="row-img">';
        echo '<img class="product-image" src="' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
        echo '</div>';
        echo '<h3>' . $row["product_name"] . '</h3>';
        echo '<div class="rating">';
        for ($i = 1; $i <= 5; $i++) {
            echo ($i <= $row["product_rating"]) ? '<span class="star">&#9733;</span>' : '<span class="star">&#9734;</span>';
        }
        echo '<a href="#">' . $row["product_rating"] . '/5</a>';
        echo '</div>';
        echo '<div class="row-in">';
        echo '<div class="row-left">';
        echo '<a href="#" class="add-to-cart-btn" data-name="' . $row["product_name"] . '" data-price="' . $row["product_price"] . '" data-image="' . $row["product_image"] . '">';
        echo '<img class="cart" src="https://img.icons8.com/?size=100&id=59997&format=png&color=000000" alt="Cart Icon">';
        echo '</a>';
        echo '</div>';
        echo '<div class="row-right">';
        echo '<h3>LKR ' . number_format($row["product_price"], 2) . '</h3>';
        echo '</div>';
        echo '</div>';
        echo '<a href="./' . strtolower(str_replace(' ', '_', $row["product_name"])) . '.html"><button class="button">View Product</button></a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p>No products available.</p>";
}

$conn->close();
?>