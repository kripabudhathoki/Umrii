<?php
session_start();
include 'dbconnect.php';

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;

$response = ['success' => false];

if ($uid > 0) {
    // Get the cart_id for the current user
    $query = "SELECT cart_id FROM cart WHERE uid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->bind_result($cart_id);
    $stmt->fetch();
    $stmt->close();

    if ($cart_id) {
        // Delete all items in the cart
        $query = "DELETE FROM cart_items WHERE cart_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();
        $stmt->close();

        // Delete the cart entry
        $query = "DELETE FROM cart WHERE cart_id = ? AND uid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $cart_id, $uid);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['grandTotal'] = 0;
        }
        $stmt->close();
    }
}

echo json_encode($response);
?>
