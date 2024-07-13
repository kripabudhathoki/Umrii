<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
if (!$is_logged_in) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$response = ['success' => false, 'message' => 'Invalid request parameters.'];

if (isset($_POST['cartItemId'])) {
    $cartItemId = intval($_POST['cartItemId']);

    // Include database connection
    include 'dbconnect.php';

    // Remove item from cart items table
    $query = "DELETE FROM cart_items WHERE cart_item_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cartItemId);

    if ($stmt->execute()) {
        
        $response = ['success' => true, 'message' => 'Item removed from cart.'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to remove item from cart.'];
    }

    $stmt->close();
    $conn->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>