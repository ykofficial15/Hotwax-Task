<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formIdentifier = $_POST['formIdentifier'];

    switch ($formIdentifier) {
        case 'partyForm':
            insertParty();
            break;
        case 'personForm':
            insertPerson();
            break;
        case 'productForm':
            insertProduct();
            break;
        case 'orderHeaderForm':
            insertOrderHeader();
            break;
        case 'orderItemForm':
            insertOrderItem();
            break;
        default:
            echo 'Invalid form identifier';
            break;
    }
} else {
    echo 'Invalid request method';
}

function insertParty() {
    global $conn;

    $partyId = $_POST['partyId'];
    $partyEnumId = $_POST['partyEnumId'];

    $stmt = $conn->prepare("INSERT INTO party (party_id, party_enum_type_id) VALUES (?, ?)");
    $stmt->bind_param("ss", $partyId, $partyEnumId);

    if ($stmt->execute()) {
        echo 'Party data inserted successfully';
    } else {
        echo 'Failed to insert party data';
    }

    $stmt->close();
    $conn->close();
}

function insertPerson() {
    global $conn;

    $partyId = $_POST['personPartyId'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];

    // Add other fields for Person table

    $stmt = $conn->prepare("INSERT INTO person (party_id, first_name, middle_name, last_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $partyId, $firstName, $middleName, $lastName);

    if ($stmt->execute()) {
        echo 'Person data inserted successfully';
    } else {
        echo 'Failed to insert person data';
    }

    $stmt->close();
    $conn->close();
}

function insertProduct() {
    global $conn;

    $productId = $_POST['productId'];
    $partyId = $_POST['productPartyId'];
    $productName = $_POST['productName'];

    // Add other fields for Product table

    $stmt = $conn->prepare("INSERT INTO product (product_id, party_id, product_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $productId, $partyId, $productName);

    if ($stmt->execute()) {
        echo 'Product data inserted successfully';
    } else {
        echo 'Failed to insert product data';
    }

    $stmt->close();
    $conn->close();
}

function insertOrderHeader() {
    global $conn;

    $orderId = $_POST['orderId'];
    $orderName = $_POST['orderName'];

    // Add other fields for Order Header table

    $stmt = $conn->prepare("INSERT INTO order_header (order_id, order_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $orderId, $orderName);

    if ($stmt->execute()) {
        echo 'Order Header data inserted successfully';
    } else {
        echo 'Failed to insert Order Header data';
    }

    $stmt->close();
    $conn->close();
}

function insertOrderItem() {
    global $conn;

    $orderId = $_POST['orderItemOrderId'];
    $orderItemSeqId = $_POST['orderItemSeqId'];
    $productId = $_POST['orderItemProductId'];

    // Add other fields for Order Item table

    $stmt = $conn->prepare("INSERT INTO order_item (order_id, order_item_seq_id, product_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $orderId, $orderItemSeqId, $productId);

    if ($stmt->execute()) {
        echo 'Order Item data inserted successfully';
    } else {
        echo 'Failed to insert Order Item data';
    }

    $stmt->close();
    $conn->close();
}
?>