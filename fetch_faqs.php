<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch FAQs
$sql = "SELECT question, answer FROM faqs WHERE status = 'answered' ORDER BY created_at DESC";
$result = $conn->query($sql);

// Prepare FAQ data
$faq_data = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faq_data .= "<div class='faq-item'>
                        <strong>{$row['question']}</strong>
                        <p>{$row['answer']}</p>
                      </div>";
    }
} else {
    $faq_data = "<p>No FAQs available at the moment.</p>";
}

// Close connection
$conn->close();

// Output FAQs
echo $faq_data;
?>