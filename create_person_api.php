<?php
include('db_connection.php');

// Handle POST request to create a person
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data (adjust as needed)
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';

    // Insert person data into the database
    $stmt = $conn->prepare("INSERT INTO person (first_name, last_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $first_name, $last_name);
    
    if ($stmt->execute()) {
        // Success, return response (you can customize the response format)
        echo json_encode(['success' => true, 'message' => 'Person created successfully']);
    } else {
        // Error handling
        echo json_encode(['success' => false, 'message' => 'Error creating person']);
    }

    $stmt->close();
}

$conn->close();
?>
