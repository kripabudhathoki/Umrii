<?php
include '../dbconnect.php';
$order_id = $_GET['order_id'];
 // Delete all items from the cart
 $stmt_items = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
 $stmt_items->bind_param('i', $order_id);
 $stmt_items->execute();
 $stmt_items->close();

 // Delete the cart itself
 $stmt_cart = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
 $stmt_cart->bind_param('i', $order_id);
 $stmt_cart->execute();
 $stmt_cart->close();
 
// $q = mysqli_query($conn, "DELETE FROM orders where order_id='$uid'");

header('location:manageorder.php?page=manage_orders');
