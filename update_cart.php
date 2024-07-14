<?php
session_start();
include 'dbconnect.php';

$cart_item_id = $_POST['cart_item_id'];
$quantity = $_POST['quantity'];

$response = ['success' => false];

if (isset($cart_item_id) && isset($quantity) && $quantity > 0) {
    $query = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $quantity, $cart_item_id);
    if ($stmt->execute()) {
        $query = "SELECT (ci.quantity * ci.unit_price) as total_price, (SELECT SUM(ci2.quantity * ci2.unit_price) FROM cart_items ci2 WHERE ci2.cart_id = ci.cart_id) as grand_total
                  FROM cart_items ci
                  WHERE ci.cart_item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cart_item_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = [
                'success' => true,
                'cartItemId' => $cart_item_id,
                'quantity' => $quantity,
                'totalPrice' => $row['total_price'],
                'grandTotal' => $row['grand_total']
            ];
        }
    }
    $stmt->close();
}
echo json_encode($response);
?>