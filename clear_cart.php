<?php

include('dbconnect.php');

session_start();
$response = array('success' => false, 'message' => 'Failed to clear cart');

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE uid = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();

    if ($cart) {
        $cart_id = $cart['cart_id'];

    
        $stmt_items = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ?");
        $stmt_items->bind_param('i', $cart_id);
        if ($stmt_items->execute()) {
            $stmt_cart = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
            $stmt_cart->bind_param('i', $cart_id);
            if ($stmt_cart->execute()) {
                $response['success'] = true;
                $response['message'] = 'Cart cleared successfully';
            }
            $stmt_cart->close();
        }
        $stmt_items->close();
    }
    $stmt->close();
}

echo json_encode($response);
?>