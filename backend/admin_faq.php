<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Answer Submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["faq_id"])) {
    $faq_id = intval($_POST["faq_id"]);
    $answer = $conn->real_escape_string($_POST["answer"]);
    $sql = "UPDATE faqs SET answer='$answer', status='answered' WHERE id=$faq_id";
    $conn->query($sql);
}

// Handle FAQ Deletion
if (isset($_GET["delete_id"])) {
    $delete_id = intval($_GET["delete_id"]);
    $conn->query("DELETE FROM faqs WHERE id=$delete_id");
    header("Location: admin_faq.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin FAQ Management</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        button { margin-top: 15px; background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        .delete-btn { background-color: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage FAQs</h2>

    <table>
        <tr>
            <th>Email</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        // Retrieve FAQs
        $result = $conn->query("SELECT * FROM faqs ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['email']}</td>
                    <td>{$row['question']}</td>
                    <td>" . ($row['answer'] ?: "Not answered yet") . "</td>
                    <td>{$row['status']}</td>
                    <td>
                        <form method='POST'>
                            <input type='hidden' name='faq_id' value='{$row['id']}'>
                            <textarea name='answer' placeholder='Enter answer'></textarea>
                            <button type='submit'>Reply</button><br>
                        </form>
                        <a class='delete-btn' href='?delete_id={$row['id']}' onclick='return confirm(\"Delete this FAQ?\")'>Delete</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>