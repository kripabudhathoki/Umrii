<?php
// Include database connection
include('dbconnect.php');

session_start();
$uid = $_SESSION['uid'];

// Fetch the most recent cart for the user
$stmt = $conn->prepare("SELECT cart_id FROM cart WHERE uid = ? ORDER BY created_at DESC LIMIT 1");
$stmt->bind_param('i', $uid);
$stmt->execute();
$result = $stmt->get_result();
$cart = $result->fetch_assoc();

if ($cart) {
    $cart_id = $cart['cart_id'];

    // Delete all items from the cart
    $stmt_items = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ?");
    $stmt_items->bind_param('i', $cart_id);
    $stmt_items->execute();
    $stmt_items->close();

    // Delete the cart itself
    $stmt_cart = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt_cart->bind_param('i', $cart_id);
    $stmt_cart->execute();
    $stmt_cart->close();
}

$stmt->close();
?>
