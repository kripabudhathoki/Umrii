<?php
session_start();
include 'dbconnect.php';

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    if (isset($_POST['pid']) && isset($_POST['quantity'])) {
        $pid = intval($_POST['pid']);
        $quantity = intval($_POST['quantity']);

        // Validate quantity
        if ($quantity <= 0 || $quantity > 100) {
            $response = ['success' => false, 'message' => 'Invalid quantity. Please enter a number between 1 and 100.'];
            echo json_encode($response);
            exit;
        }

        // Check if the user has an existing cart
        $cart_id_query = $conn->query("SELECT cart_id FROM cart WHERE uid = $uid");
        if ($cart_id_query->num_rows > 0) {
            $cart_id_row = $cart_id_query->fetch_assoc();
            $cart_id = $cart_id_row['cart_id'];

            // Check if the product is already in the cart
            $existing_item_query = $conn->query("SELECT * FROM cart_items WHERE cart_id = $cart_id AND pid = $pid");
            if ($existing_item_query->num_rows > 0) {
                $response = ['success' => false, 'message' => 'Product already in cart'];
            } else {
                $result = $conn->query("SELECT * FROM products WHERE pid = $pid");
                $product = $result->fetch_assoc();

                if ($product) {
                    $unit_price = $product['product_price'];

                    $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, pid, quantity, unit_price) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiid", $cart_id, $pid, $quantity, $unit_price);
                    $stmt->execute();
                    $stmt->close();

                    $response = ['success' => true, 'message' => 'Product added to cart'];
                } else {
                    $response = ['success' => false, 'message' => 'Product not found'];
                }
            }
        } else {
            // Create a new cart if none exists
            $conn->query("INSERT INTO cart (uid, created_at) VALUES ($uid, NOW())");
            $cart_id = $conn->insert_id;

            $result = $conn->query("SELECT * FROM products WHERE pid = $pid");
            $product = $result->fetch_assoc();

            if ($product) {
                $unit_price = $product['product_price'];

                $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, pid, quantity, unit_price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $cart_id, $pid, $quantity, $unit_price);
                $stmt->execute();
                $stmt->close();

                $response = ['success' => true, 'message' => 'Product added to cart'];
            } else {
                $response = ['success' => false, 'message' => 'Product not found'];
            }
        }
    } else {
        $response = ['success' => false, 'message' => 'Invalid request: pid or quantity parameter missing'];
    }
} else {
    $response = ['success' => false, 'message' => 'User not authenticated'];
}

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>