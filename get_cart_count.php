<?php
session_start();
include "dbconnect.php"; // Include your database connection file

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    // Query to get cart count
    $sql = "SELECT COUNT(ci.cart_item_id) AS cart_count
            FROM cart_items ci
            INNER JOIN cart c ON ci.cart_id = c.cart_id
            WHERE c.uid = $uid";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // Output cart count
    echo $row['cart_count'];
} else {
    echo ""; // Default to 0 if user is not logged in or no cart items found
}

mysqli_close($conn); // Close database connection
?>