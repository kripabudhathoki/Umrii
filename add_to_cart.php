<?php
session_start();
include 'dbconnect.php'; // Include your database connection file

// Check if the user is logged in and uid is set in session
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1; // Default quantity is 1

        // Check if a cart already exists for the user
        $cart_id_query = $conn->query("SELECT cart_id FROM cart WHERE uid = $uid");
        if ($cart_id_query->num_rows > 0) {
            // Cart exists, fetch cart_id
            $cart_id_row = $cart_id_query->fetch_assoc();
            $cart_id = $cart_id_row['cart_id'];

            // Check if the product already exists in the cart
            $existing_item_query = $conn->query("SELECT * FROM cart_items WHERE cart_id = $cart_id AND pid = $pid");
            if ($existing_item_query->num_rows > 0) {
                // Product already exists, send error response
                echo json_encode(['success' => false, 'message' => 'Product already in cart']);
                exit; // Exit script after sending response
            } else {
                // Product does not exist, insert new entry
                $result = $conn->query("SELECT * FROM products WHERE pid = $pid");
                $product = $result->fetch_assoc();

                if ($product) {
                    $unit_price = $product['product_price'];

                    // Use prepared statements to avoid SQL injection
                    $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, pid, quantity, unit_price) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiid", $cart_id, $pid, $quantity, $unit_price);
                    $stmt->execute();
                    $stmt->close();

                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Product not found']);
                    exit; // Exit if product not found
                }
            }
        } else {
            // Cart does not exist, create a new cart and add product
            $conn->query("INSERT INTO cart (uid, created_at) VALUES ($uid, NOW())");
            $cart_id = $conn->insert_id; // Retrieve the auto-generated cart_id

            $result = $conn->query("SELECT * FROM products WHERE pid = $pid");
            $product = $result->fetch_assoc();

            if ($product) {
                $unit_price = $product['product_price'];

                // Use prepared statements to avoid SQL injection
                $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, pid, quantity, unit_price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $cart_id, $pid, $quantity, $unit_price);
                $stmt->execute();
                $stmt->close();

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Product not found']);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request: pid parameter missing']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
}
?>