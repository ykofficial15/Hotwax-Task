<?php
include('db_connection.php');

// Handle GET request to get all orders
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all orders with their corresponding order items
    $result = $conn->query("SELECT * FROM order_header");
    $orders = [];

    if ($result) {
        while ($orderRow = $result->fetch_assoc()) {
            $orderId = $orderRow['order_id'];

            // Retrieve order items for the current order
            $itemResult = $conn->query("SELECT * FROM order_item WHERE order_id = '$orderId'");
            $orderItems = [];

            if ($itemResult) {
                while ($itemRow = $itemResult->fetch_assoc()) {
                    $orderItems[] = $itemRow;
                }

                $itemResult->close();
            } else {
                // Debugging: Print error message
                echo 'Error fetching order items: ' . $conn->error;
                // Handle error fetching order items
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Error fetching order items']);
                exit;
            }

            // Add order items to the current order
            $orderRow['order_items'] = $orderItems;

            $orders[] = $orderRow;
        }

        // Debugging: Print success message
        echo 'Orders fetched successfully';
        
        // Return success response
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'orders' => $orders]);

        $result->close();
    } else {
        // Debugging: Print error message
        echo 'Error fetching orders: ' . $conn->error;
        // Handle error fetching orders
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error fetching orders']);
    }
}

$conn->close();
?>
