<?php

include('dbconnect.php');


$order_id = $_GET['purchase_order_id'];
$payment_status = $_GET['status']; 

if ($order_id) {
    if ($payment_status === 'Completed') {
       
        $stmt = $conn->prepare("UPDATE orders SET is_paid = 1, status = 'Pending' WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $stmt->close();
    } else {
        
        $stmt = $conn->prepare("UPDATE orders SET is_paid = 0, status = 'Failed' WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $stmt->close();
    }


    unset($_SESSION['order_id']);
    unset($_SESSION['purchase_order_id']);

    header('Location: myorder.php');
    exit();
} else {
    echo "Order not found.";
}
?>
