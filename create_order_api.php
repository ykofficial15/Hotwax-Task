<?php
include('db_connection.php');

// Handle POST request to create an order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data (adjust as needed)
    $order_name = $_POST['order_name'] ?? '';
    $placed_date = $_POST['placed_date'] ?? '';
    // Add other parameters as needed

    // Insert order data into the database
    $stmt = $conn->prepare("INSERT INTO order_header (order_name, placed_date) VALUES (?, ?)");
    $stmt->bind_param("ss", $order_name, $placed_date);
    
    if ($stmt->execute()) {
        // Success, return response (you can customize the response format)
        $order_id = $stmt->insert_id;
        echo json_encode(['success' => true, 'message' => 'Order created successfully', 'order_id' => $order_id]);
    } else {
        // Error handling
        echo json_encode(['success' => false, 'message' => 'Error creating order']);
    }

    $stmt->close();
}

$conn->close();
?>
