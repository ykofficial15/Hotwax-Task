<?php
include('db_connection.php');

// Handle POST request to create an order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate input data
    $order_name = $_POST['order_name'] ?? '';
    $placed_date = $_POST['placed_date'] ?? '';
    $approved_date = $_POST['approved_date'] ?? '';
    $status_id = $_POST['status_id'] ?? 'OrderPlaced'; // Default to 'OrderPlaced' if not provided
    $party_id = $_POST['party_id'] ?? '';
    $currency_uom_id = $_POST['currency_uom_id'] ?? 'USD'; // Default to 'USD' if not provided
    $product_store_id = $_POST['product_store_id'] ?? '';
    $sales_channel_enum_id = $_POST['sales_channel_enum_id'] ?? '';
    $grand_total = $_POST['grand_total'] ?? '';
    $completed_date = $_POST['completed_date'] ?? '';

    // Generate a unique order_id
    $order_id = uniqid('ORD');

    // Insert order data into the database
    $stmtOrder = $conn->prepare("INSERT INTO order_header (order_id, order_name, placed_date, approved_date, status_id, party_id, currency_uom_id, product_store_id, sales_channel_enum_id, grand_total, completed_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtOrder->bind_param("ssssssssssd", $order_id, $order_name, $placed_date, $approved_date, $status_id, $party_id, $currency_uom_id, $product_store_id, $sales_channel_enum_id, $grand_total, $completed_date);

    // Execute the order insert statement
    if (!$stmtOrder->execute()) {
        // Error handling
        echo json_encode(['success' => false, 'message' => 'Error creating the order']);
        exit;
    }

    $stmtOrder->close();

    // Success, return response
    echo json_encode(['success' => true, 'orderId' => $order_id, 'message' => 'Order created successfully']);
}

$conn->close();
?>
