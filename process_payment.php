<?php
include('dbconnect.php');

function calculateTotalPrice($conn, $uid) {
    $total_price = 100;
    $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE uid = ? ORDER BY created_at DESC LIMIT 1");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();
    if ($cart) {
        $cart_id = $cart['cart_id'];
        $stmt_items = $conn->prepare("SELECT pid, quantity, unit_price FROM cart_items WHERE cart_id = ?");
        if (!$stmt_items) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_items->bind_param('i', $cart_id);
        $stmt_items->execute();
        $result_items = $stmt_items->get_result();
        while ($row = $result_items->fetch_assoc()) {
            $total_price += $row['unit_price'] * $row['quantity'];
        }
        $stmt_items->close();
    }
    $stmt->close();
    return $total_price;
}

function insertOrderItems($conn, $order_id, $cart_id) {
    $stmt = $conn->prepare("SELECT pid, quantity, unit_price FROM cart_items WHERE cart_id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param('i', $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $pid = $row['pid'];
        $quantity = $row['quantity'];
        $unit_price = $row['unit_price'];
        $stmt_order_items = $conn->prepare("INSERT INTO order_items (order_id, pid, quantity, unit_price) VALUES (?, ?, ?, ?)");
        if (!$stmt_order_items) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_order_items->bind_param('iiid', $order_id, $pid, $quantity, $unit_price);
        if ($stmt_order_items->execute() === FALSE) {
            echo "Error inserting order item: " . $stmt_order_items->error;
        }
        $stmt_order_items->close();
    }
    $stmt->close();
}

function generateUniqueId($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    
    return $randomString;
}

$transaction_id= generateUniqueId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];

    session_start();
    $uid = $_SESSION['uid'];

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO checkouts (first_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param('sssss', $first_name, $last_name, $email, $phone, $address);
        if ($stmt->execute() === FALSE) {
            throw new Exception("Error inserting checkout: " . $stmt->error);
        }
        $checkout_id = $stmt->insert_id;
        $stmt->close();

        $total_price = calculateTotalPrice($conn, $uid);
        $status = 'Pending';
        $is_paid = 0;

        $stmt = $conn->prepare("INSERT INTO orders (order_date, uid, checkout_id, total_price, status, is_paid, payment_method, transaction_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?,?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param('iidsiss', $uid, $checkout_id, $total_price, $status, $is_paid, $payment_method,$transaction_id);
        if ($stmt->execute() === FALSE) {
            throw new Exception("Error inserting order: " . $stmt->error);
        }
        $order_id = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE uid = ? ORDER BY created_at DESC LIMIT 1");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart = $result->fetch_assoc();
        $cart_id = $cart['cart_id'];
        $stmt->close();

        insertOrderItems($conn, $order_id, $cart_id);

        if ($payment_method === 'cod') {
            $conn->commit();
            include('clear_cart.php');
            header('Location: myorder.php');
            exit();
        } else {
            $conn->commit();
            include('clear_cart.php');
            $_SESSION['order_id'] = $order_id;
            $_SESSION['purchase_order_id'] = $order_id;
            header('Location: khalti_payment.php?order_id=' . $order_id);
            exit();
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
