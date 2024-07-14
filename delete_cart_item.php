<?php
session_start();
include 'dbconnect.php';

$cart_item_id = $_POST['cart_item_id'];
$response = ['success' => false];

if (isset($cart_item_id)) {
  
    $query_fetch = "SELECT cart_id, unit_price FROM cart_items WHERE cart_item_id = ?";
    $stmt_fetch = $conn->prepare($query_fetch);
    $stmt_fetch->bind_param("i", $cart_item_id);
    $stmt_fetch->execute();
    $result_fetch = $stmt_fetch->get_result();
    
    if ($result_fetch->num_rows > 0) {
        $row_fetch = $result_fetch->fetch_assoc();
        $cart_id = $row_fetch['cart_id'];
        $unit_price = $row_fetch['unit_price'];
        
      
        $query_delete = "DELETE FROM cart_items WHERE cart_item_id = ?";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("i", $cart_item_id);
        
        if ($stmt_delete->execute()) {
            
            $query_grand_total = "SELECT SUM(ci.quantity * ci.unit_price) as grand_total
                                  FROM cart_items ci
                                  WHERE ci.cart_id = ?";
            $stmt_grand_total = $conn->prepare($query_grand_total);
            $stmt_grand_total->bind_param("i", $cart_id);
            $stmt_grand_total->execute();
            $result_grand_total = $stmt_grand_total->get_result();
            
            if ($result_grand_total->num_rows > 0) {
                $row_grand_total = $result_grand_total->fetch_assoc();
                $response = [
                    'success' => true,
                    'grandTotal' => floatval($row_grand_total['grand_total']),
                    'cartItemId' => $cart_item_id
                ];
            } else {
               
                $response = [
                    'success' => true,
                    'grandTotal' => 0,
                    'cartItemId' => $cart_item_id
                ];
            }
        } else {
            // If deletion fails
            $response = [
                'success' => false
            ];
        }
    }
    
    $stmt_fetch->close();
    $stmt_delete->close();
    $stmt_grand_total->close();
}

echo json_encode($response);
?>