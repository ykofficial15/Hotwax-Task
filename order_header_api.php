<?php
include('db_connection.php');

// Retrieve all order headers
$result = $conn->query("SELECT * FROM order_header");
$orderHeaders = [];
while ($row = $result->fetch_assoc()) {
    $orderHeaders[] = $row;
}

header('Content-Type: application/json');
echo json_encode($orderHeaders);

$conn->close();
?>
