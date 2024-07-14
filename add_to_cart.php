<?php
session_start();
include 'dbconnect.php';


if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

        
        $cart_id_query = $conn->query("SELECT cart_id FROM cart WHERE uid = $uid");
        if ($cart_id_query->num_rows > 0) {
           
            $cart_id_row = $cart_id_query->fetch_assoc();
            $cart_id = $cart_id_row['cart_id'];

           
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
        $response = ['success' => false, 'message' => 'Invalid request: pid parameter missing'];
    }
} else {
    $response = ['success' => false, 'message' => 'User not authenticated'];
}

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>