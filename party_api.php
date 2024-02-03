<?php
include('db_connection.php');

// Retrieve all parties
$result = $conn->query("SELECT * FROM party");
$parties = [];
while ($row = $result->fetch_assoc()) {
    $parties[] = $row;
}

header('Content-Type: application/json');
echo json_encode($parties);

$conn->close();
?>
