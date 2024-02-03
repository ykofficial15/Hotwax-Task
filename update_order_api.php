<?php
include('db_connection.php');

// Handle PUT request to update an order
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Retrieve and validate input data (adjust as needed)
    parse_str(file_get_contents("php://input"), $_PUT);

    $order_id = $_PUT['order_id'] ?? '';
    $new_order_name = $_PUT['order_name'] ?? '';

    // Update order name in the database
    $stmt = $conn->prepare("UPDATE order_header SET order_name = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $new_order_name, $order_id);

    if ($stmt->execute()) {
        // Success, return response (you can customize the response format)
        echo json_encode(['success' => true, 'message' => 'Order updated successfully']);
    } else {
        // Error handling
        echo json_encode(['success' => false, 'message' => 'Error updating order']);
    }

    $stmt->close();
}

$conn->close();
?>
