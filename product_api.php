<?php
include('db_connection.php');

// Retrieve all products
$result = $conn->query("SELECT * FROM product");
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>
