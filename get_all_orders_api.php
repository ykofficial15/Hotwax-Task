<?php
include('db_connection.php');

// Handle GET request to get all orders
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all orders
    $result = $conn->query("SELECT * FROM order_header");
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    // Return response
    header('Content-Type: application/json');
    echo json_encode(['orders' => $orders]);

    $result->close();
}

$conn->close();
?>
