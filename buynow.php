<?php
header('Content-Type: application/json');

// Database connection (Update the credentials as needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pulsetitandb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Simulate product catalog (ideally fetched from the database)
$productCatalog = [
    "DB001" => ["Dumbell Bar", 2100.00],
    "DB002" => ["Soft Dumbell", 3000.00],
    "DB003" => ["Steel Dumbell - 8kg", 8500.00],
    "EB001" => ["Exercise Bikes - WESLO", 15000.00],
    "TM001" => ["Treadmill - WESLO (90KG)", 200000.00],
    "DS001" => ["Dumbell Set", 28000.00],
    "MT001" => ["Men's Trackbottom", 4000.00],
    "WT001" => ["Women's Sport T-shirt", 2000.00],
    "YM001" => ["Yoga Mats", 3000.00],
    "HH001" => ["Hoola Hoops", 2000.00],
    "CT001" => ["Cross-Trainer", 129000.00],
    "SG001" => ["All-In-One Strength Gym", 250000.00],
    "FK001" => ["Fitness Pulldown Kit", 11000.00],
    "NS001" => ["Nature-Craft Enhancing Supplement", 15000.00],
    "NM001" => ["Naturello Multi-Vitamin", 20000.00],
    "NK001" => ["Naturemade K-13 Vitamin", 12000.00],
    "NK002" => ["Naturemade K-2 Vitamin", 14000.00],
    "MP001" => ["Muscle Protein Powder", 25000.00],
    "CS001" => ["Creatine Bodybuilding Supplement", 9000.00],
    "SC001" => ["Stair-Climber", 300000.00],
    "SB001" => ["Stationary Bike", 160000.00]
];

// Retrieve form data
$user_name = $_POST['firstname'] ?? null;
$user_email = $_POST['email'] ?? null;
$user_phone = $_POST['phone'] ?? null;
$shipping_address = $_POST['address'] ?? null;
$product_codes = $_POST['product_code'] ?? [];
$quantities = $_POST['quantity'] ?? [];

// Validate the form data
if (!$user_name || !$user_email || !$user_phone || !$shipping_address || empty($product_codes) || empty($quantities)) {
    die(json_encode(["error" => "Incomplete order details. Please provide all required fields."]));
}

// Initialize order summary
$total_order_cost = 0;
$order_details = [];

// Use prepared statements for security and efficiency
$stmt = $conn->prepare("INSERT INTO orders (
    user_name, 
    user_email, 
    user_phone, 
    shipping_address, 
    product_code, 
    product_name, 
    price_per_unit, 
    quantity, 
    subtotal_price
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssdii", $user_name, $user_email, $user_phone, $shipping_address, $product_code, $product_name, $price_per_unit, $quantity, $subtotal_price);

// Process each product
foreach ($product_codes as $index => $product_code) {
    $quantity = $quantities[$index];

    if (isset($productCatalog[$product_code])) {
        $product_name = $productCatalog[$product_code][0];
        $price_per_unit = $productCatalog[$product_code][1];
        $subtotal_price = $quantity * $price_per_unit;

        $total_order_cost += $subtotal_price;

        // Execute prepared statement for insertion
        $stmt->execute();

        // Add product to order details
        $order_details[] = [
            "product_code" => $product_code,
            "product_name" => $product_name,
            "price_per_unit" => $price_per_unit,
            "quantity" => $quantity,
            "subtotal_price" => $subtotal_price
        ];
    } else {
        die(json_encode(["error" => "Invalid product code: $product_code"]));
    }
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();

// Return a success message with order summary
echo json_encode([
    "message" => "Order placed successfully!",
    "total_order_cost" => $total_order_cost,
    "order_details" => $order_details
]);
?>