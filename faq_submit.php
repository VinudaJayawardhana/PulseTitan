<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle FAQ Submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST["email"]);
    $question = $conn->real_escape_string($_POST["question"]);
    
    $sql = "INSERT INTO faqs (email, question, status) VALUES ('$email', '$question', 'pending')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('FAQ submitted successfully!'); window.location='faq_submit.php';</script>";
    } else {
        echo "<script>alert('Error submitting FAQ: " . $conn->error . "');</script>";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Submission</title>
    <style>
        body {
            
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; padding: 20px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('C:\xampp\htdocs\projectpulse\Apparel\FAQ.jpg'); /* Background image with gradient overlay */
            background-size: cover;
            background-position: center;
            color: rgb(16, 15, 15);
         }

        .container { max-width: 600px;
             margin: auto;
             background: white; 
             padding: 20px;
              border-radius: 8px; 
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        h2 {
             text-align: center;
             }
        label { font-weight: bold;
             display: block;
              margin-top: 10px; }
        input, textarea { width: 100%;
             padding: 10px;
              margin-top: 5px;
               border: 1px solid #ccc;
                border-radius: 4px;
             }
        button { margin-top: 15px; 
            background-color: #007bff;
             color: white; 
             padding: 10px; 
             border: none;
              border-radius: 
              5px; cursor: pointer;
             }
        button:hover { background-color: #0056b3;
         }
        .faq-section { margin-top: 30px;
             background: #fff;
              padding: 15px;
               border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            }
        .faq-item { margin-bottom: 10px;
             padding: 10px;
              background: #e9ecef;
               border-radius: 5px;
             }
        .faq-item strong { display: block;
             margin-bottom: 5px;
             }
    </style>
</head>
<body>

<div class="container">
    <h2>Submit a Question</h2>
    
    <form action="faq_submit.php" method="POST">
        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="question">Your Question:</label>
        <textarea id="question" name="question" required></textarea>

        <button type="submit">Submit Question</button>
    </form>
</div>

<!-- Frequently Asked Questions Section -->
<div class="faq-section">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <strong>How do I reset my password?</strong>
        You can reset your password by clicking "Forgot Password" on the login page and following the instructions.
    </div>

    <div class="faq-item">
        <strong>What payment methods do you accept?</strong>
        We accept credit/debit cards, PayPal, and bank transfers.
    </div>

    <div class="faq-item">
        <strong>How can I track my order?</strong>
        After placing an order, you'll receive a tracking number via email. You can use it on our tracking page.
    </div>

    <div class="faq-item">
        <strong>What is your return policy?</strong>
        You can return products within 30 days of purchase, provided they are unused and in original packaging.
    </div>

    <div class="faq-item">
        <strong>Do you offer international shipping?</strong>
        Yes, we ship worldwide. Shipping costs and delivery times may vary based on location.
    </div>
</div>


    <?php include 'fetch_faqs.php'; ?>
</div>

</body>
</html>