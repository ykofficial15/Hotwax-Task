<?php
include('db_connection.php');

// Handle POST request to add order items
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data (adjust as needed)
    $order_id = $_POST['order_id'] ?? '';
    // Add other parameters as needed

    // Insert order items data into the database
    foreach ($_POST['order_items'] as $item) {
        // Retrieve and validate item data
        $order_item_seq_id = $item['order_item_seq_id'] ?? '';
        // Add other parameters as needed

        // Insert order item data into the database
        $stmt = $conn->prepare("INSERT INTO order_item (order_id, order_item_seq_id) VALUES (?, ?)");
        $stmt->bind_param("ss", $order_id, $order_item_seq_id);
        
        if (!$stmt->execute()) {
            // Error handling
            echo json_encode(['success' => false, 'message' => 'Error adding order items']);
            exit;
        }

        $stmt->close();
    }

    // Success, return response (you can customize the response format)
    echo json_encode(['success' => true, 'message' => 'Order items added successfully']);
}

$conn->close();
?>
