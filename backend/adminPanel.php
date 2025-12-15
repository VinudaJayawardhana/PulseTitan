
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #343a40;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        /* Section Separation */
        .section {
            margin-bottom: 40px;
        }

        /* Form Container */
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin: 20px 0;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input, select, button {
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        input:focus, select:focus, button:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design for Small Screens */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Users Table Section -->
        <section class="section">
            <h2>Users Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'C:/xampp/htdocs/projectpulse/backend/userData.php'; ?>
                </tbody>
            </table>
        </section>

        
        <section class="form-container">
    <h1>Post a Product</h1>
    <form action="addProduct.php" enctype="multipart/form-data" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_image">Upload Image:</label>
        <input type="file" id="product_image" name="product_image" accept="image/*" required>

        <label for="product_price">Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01" required>

        <label for="product_rating">Rating:</label>
        <input type="number" id="product_rating" name="product_rating" step="0.1" min="0" max="5" required>

        <label for="product_link">Product Link:</label>
        <input type="url" id="product_link" name="product_link" required>

        <label for="product_category">Category:</label>
        <select id="product_category" name="product_category" required>
            <option value="Equipment">Equipment</option>
            <option value="Accessories">Accessories</option>
            <option value="Apparel">Apparel</option>
            <option value="Supplement">Supplement</option>
        </select>

        <button type="submit" name="btnSubmit">Submit Product</button>
    </form>
</section>

<section class="form-container">
    <h2>Delete a Product</h2>
    <form action="deleteProduct.php" method="POST">
        <label for="delete_id">Enter Product ID to Delete:</label>
        <input type="number" id="delete_id" name="product_id" required>
        <button type="submit" name="btnDelete">Delete Product</button>
    </form>
</section>
        <section class="section">
            <h1>Product Details</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Product Rating</th>
                            <th>Product Link</th>
                            <th>Product Category</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'C:\xampp\htdocs\projectpulse\backend\productData.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="form-container">
    <h2>Update a Product</h2>
    <form action="updateProduct.php" method="POST">
        <label for="update_id">Product ID:</label>
        <input type="number" id="update_id" name="product_id" required>

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name">

        <label for="product_price">Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01">

        <label for="product_rating">Rating:</label>
        <input type="number" id="product_rating" name="product_rating" step="0.1" min="0" max="5">

        <label for="product_link">Product Link:</label>
        <input type="url" id="product_link" name="product_link">

        <label for="product_category">Category:</label>
        <select id="product_category" name="product_category">
            <option value="Equipment">Equipment</option>
            <option value="Accessories">Accessories</option>
            <option value="Apparel">Apparel</option>
            <option value="Supplement">Supplement</option>
        </select>

        <button type="submit" name="btnUpdate">Update Product</button>
    </form>
</section>
        <!-- Order Details Table Section -->
        <section class="section">
            <h1>Order Details</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Shipping Address</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price Per Unit (LKR)</th>
                            <th>Quantity</th>
                            <th>Subtotal Price (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'C:/xampp/htdocs/projectpulse/backend/orderData.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>
       <section>
        <h2>Please click to answer the reply to questions</h2>
        <button><a href="admin_faq.php">View Reviews</a></button>

    </section>
    </div>
</body>
</html>