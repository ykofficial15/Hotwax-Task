<?php
include('db_connection.php');

// Retrieve all persons
$result = $conn->query("SELECT * FROM person");
$persons = [];
while ($row = $result->fetch_assoc()) {
    $persons[] = $row;
}

header('Content-Type: application/json');
echo json_encode($persons);

$conn->close();
?>
