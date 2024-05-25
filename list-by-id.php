<?php
require('config.php');

// Check if 'id' is set in the GET request and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $edited_id = $_GET['id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, image, price, category, genderclass FROM glitterdetails WHERE id = ?");
    $stmt->bind_param("i", $edited_id); // 'i' denotes the type (integer)

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the data as an associative array and encode it as JSON
            echo json_encode($result->fetch_assoc());
        } else {
            // No results found
            echo json_encode(['message' => 'No results found']);
        }
    } else {
        // Query execution error
        echo json_encode(['message' => 'Query execution failed']);
    }

    // Close the statement
    $stmt->close();
} else {
    // 'id' not set in the request
    echo json_encode(['message' => 'Invalid ID']);
}

// Close the database connection
$conn->close();
?>
