<?php
include('db_connection.php');

// Retrieve all order items
$result = $conn->query("SELECT * FROM order_item");
$orderItems = [];
while ($row = $result->fetch_assoc()) {
    $orderItems[] = $row;
}

header('Content-Type: application/json');
echo json_encode($orderItems);

$conn->close();
?>
