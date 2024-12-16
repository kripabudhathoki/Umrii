<?php
require 'dbconnect.php';

function sendOrderConfirmationEmail($conn) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $uid = $_SESSION['uid'];

 
    $stmt = $conn->prepare("
        SELECT 
            u.fname, u.lname, u.email, u.phone, u.address,
            o.order_id, o.transaction_id, o.total_price, o.payment_method,
            p.product_name, oi.quantity, oi.unit_price
        FROM 
            users u
        JOIN 
            orders o ON u.uid = o.uid
        JOIN 
            order_items oi ON o.order_id = oi.order_id
        JOIN 
            products p ON oi.pid = p.pid
        WHERE 
            u.uid = ?
        ORDER BY 
            o.order_date DESC
        LIMIT 1
    ");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $orderData = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if (!$orderData) {
        die("No order data found for the user.");
    }

   
    $firstRow = $orderData[0];
    $first_name = $firstRow['fname'];
    $last_name = $firstRow['lname'];
    $email = $firstRow['email'];
    $phone = $firstRow['phone'];
    $address = $firstRow['address'];
    $order_id = $firstRow['order_id'];
    $transaction_id = $firstRow['transaction_id'];
    $total_price = $firstRow['total_price'];
    $payment_method = $firstRow['payment_method'];

 
    $productDetails = "";
    foreach ($orderData as $row) {
        $productDetails .= "Product: {$row['product_name']}, Quantity: {$row['quantity']}, Unit Price: {$row['unit_price']}\n";
    }

    $subject = "Order Confirmation - Your Order with Transaction ID $transaction_id";
    $message = "
    Hello $first_name $last_name,

    Thank you for your order!

    Your order has been placed successfully. Here are your order details:

    Order ID: $order_id
    Transaction ID: $transaction_id
    Total Price: $total_price
    Payment Method: $payment_method
    Address: $address

    Products Ordered:
    $productDetails

    We will notify you once your order is shipped.

    Thank you for shopping with us!

    Best regards,
    UMRII
    ";
    $headers = "From: kripa.budhathoki10@gmail.com";

    return mail($email, $subject, $message, $headers);
}
?>
