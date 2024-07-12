<?php
session_start();
include 'db_connection.php'; // Include your database connection file

$uid = $_SESSION['uid']; // Assume user ID is stored in session

$result = $conn->query("SELECT ci.cart_item_id, p.product_name, ci.quantity, ci.unit_price, (ci.quantity * ci.unit_price) as total_price FROM cart_items ci JOIN products p ON ci.pid = p.pid WHERE ci.cart_id = (SELECT cart_id FROM cart WHERE uid = $uid)");

$cart_items = [];
$grand_total = 0;

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $grand_total += $row['total_price'];
}

echo json_encode(['cart_items' => $cart_items, 'grand_total' => $grand_total]);
?>
