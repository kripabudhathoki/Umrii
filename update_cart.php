<?php
session_start();
include 'db_connection.php'; // Include your database connection file

if (isset($_POST['cart_item_id']) && isset($_POST['quantity'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $quantity = $_POST['quantity'];

    $conn->query("UPDATE cart_items SET quantity = $quantity WHERE cart_item_id = $cart_item_id");
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
