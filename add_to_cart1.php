<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include "dbconnect.php";

if (isset($_GET['pid'])) {
    $pid = intval($_GET['pid']);

    // Query to fetch the product details
    $sql = "SELECT * FROM products WHERE pid = $pid";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $product = [
            'pid' => $row['pid'],
            'product_name' => $row['product_name'],
            'product_image' => $row['product_image'],
            'product_price' => $row['product_price'],
            'quantity' => 1
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        if (array_key_exists($pid, $_SESSION['cart'])) {
            $_SESSION['cart_alert'] = "Item is already in the cart.";
        } else {
            $_SESSION['cart'][$pid] = $product;
            $_SESSION['cart_alert'] = "Item added to the cart.";
        }
    }
}

mysqli_close($conn);

header("Location: cart.php");
exit;
?>
