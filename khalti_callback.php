<?php

include('dbconnect.php');
include('email_service.php');

if (!isset($_GET['status']) || !isset($_GET['purchase_order_id']) || !isset($_GET['purchase_order_name'])) {
    die("Invalid request.");
}

$order_id = $_GET['purchase_order_id'];
$payment_status = $_GET['status']; 
$order_name = $_GET['purchase_order_name'];

$tid=str_replace('Order #', '', $order_name);


if ($order_id) {
    if ($payment_status === 'Completed') {
       
        $stmt = $conn->prepare("UPDATE orders SET is_paid = 1, status = 'Pending' WHERE order_id = ? and transaction_id= ?");
        $stmt->bind_param('is', $order_id, $tid);
        $stmt->execute();
        $stmt->close();
        if (sendOrderConfirmationEmail($conn)) {
            echo "Confirmation email sent.";
        } else {
            echo "Failed to send confirmation email.";
        }
    } else {
        
        $stmt = $conn->prepare("UPDATE orders SET is_paid = 0, status = 'Failed' WHERE order_id = ? and transaction_id= ?");
        $stmt->bind_param('is', $order_id, $tid);
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
