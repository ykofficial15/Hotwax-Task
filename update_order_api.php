<?php
include('db_connection.php');

// Handle POST request to update order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data (adjust as needed)
    $order_id = $_POST['order_id'] ?? '';
    $new_order_name = $_POST['order_name'] ?? '';

    // Update the order name in the database
    $stmt = $conn->prepare("UPDATE order_header SET order_name = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $new_order_name, $order_id);

    if ($stmt->execute()) {
        // Retrieve the updated order details
        $updated_order = $conn->query("SELECT * FROM order_header WHERE order_id = '$order_id'");
        $updated_order_data = $updated_order->fetch_assoc();

        // Return the updated order details in the response
        header('Content-Type: application/json');
        echo json_encode($updated_order_data);
    } else {
        // Handle update error
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error updating order']);
    }

    $stmt->close();
}

$conn->close();
?>
