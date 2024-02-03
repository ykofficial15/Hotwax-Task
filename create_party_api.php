<?php
include('db_connection.php');

// Handle POST request to create a party
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data (adjust as needed)
    $party_id = $_POST['party_id'] ?? '';
    // Add other parameters as needed

    // Insert party data into the database
    $stmt = $conn->prepare("INSERT INTO party (party_id) VALUES (?)");
    $stmt->bind_param("s", $party_id);
    
    if ($stmt->execute()) {
        // Success, return response (you can customize the response format)
        echo json_encode(['success' => true, 'message' => 'Party created successfully']);
    } else {
        // Error handling
        echo json_encode(['success' => false, 'message' => 'Error creating party']);
    }

    $stmt->close();
}

$conn->close();
?>
