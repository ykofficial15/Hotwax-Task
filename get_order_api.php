<?php
include('db_connection.php');

// Handle GET request to get a specific order
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve order details (you need to adjust this based on your database structure)
    $order_id = $_GET['order_id'] ?? '';

    // Fetch order data from the database (customize SQL query as needed)
    $result = $conn->query("SELECT * FROM order_header WHERE order_id = '$order_id'");
    $order = $result->fetch_assoc();

    if ($order) {
        // Return response
        header('Content-Type: application/json');
        echo json_encode($order);
    } else {
        // Order not found
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Order not found']);
    }

    $result->close();
}

$conn->close();
?>
