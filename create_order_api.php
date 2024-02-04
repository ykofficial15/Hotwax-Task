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

    // Generate a unique order_id (you can modify this part as needed)
    $order_id = uniqid('ORD');

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO order_header (order_id, order_name, placed_date, approved_date, status_id, party_id, currency_uom_id, product_store_id, sales_channel_enum_id, grand_total, completed_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $order_id, $order_name, $placed_date, $approved_date, $status_id, $party_id, $currency_uom_id, $product_store_id, $sales_channel_enum_id, $grand_total, $completed_date);

    // Execute the statement and handle success/error
    try {
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Order created successfully', 'order_id' => $order_id]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error creating order', 'error' => $e->getMessage()]);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
 