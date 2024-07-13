<?php
session_start();

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cartItemId']) && isset($_POST['quantity'])) {
    $cartItemId = $_POST['cartItemId'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the database
    $updateQuery = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $quantity, $cartItemId);
    $stmt->execute();
    $stmt->close();

    // Fetch updated cart item details
    $fetchQuery = "SELECT ci.cart_item_id, p.product_name, ci.quantity, ci.unit_price, (ci.quantity * ci.unit_price) AS total_price, p.product_image
                  FROM cart_items ci
                  JOIN products p ON ci.pid = p.pid
                  WHERE ci.cart_item_id = ?";
    $stmt = $conn->prepare($fetchQuery);
    $stmt->bind_param("i", $cartItemId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Calculate total price
        $totalPrice = $row['total_price'];

        $updatedRow = '
            <tr class="text-center" data-cart-item-id="' . $row['cart_item_id'] . '">
                <td class="product-remove">
                    <button class="btn btn-link remove-item" data-cart-item-id="' . $row['cart_item_id'] . '">
                        <span class="bi bi-x-circle"></span>
                    </button>
                </td>
                <td class="image-prod">
                    <img src="assets/img/' . $row['product_image'] . '" alt="' . $row['product_name'] . '" style="height: 100px; width: 100px;">
                </td>
                <td class="product-name">
                    <h4>' . $row['product_name'] . '</h4>
                </td>
                <td class="price">$ ' . $row['unit_price'] . '</td>
                <td class="quantity">
                    <input type="number" class="form-control update-quantity" data-cart-item-id="' . $row['cart_item_id'] . '" value="' . $row['quantity'] . '" min="1">
                </td>
                <td class="total">$ ' . $totalPrice . '</td>
            </tr>';

        // Calculate new grand total
        $grandTotalQuery = "SELECT SUM(ci.quantity * ci.unit_price) AS grand_total
                            FROM cart_items ci
                            WHERE ci.cart_id = (SELECT cart_id FROM cart WHERE uid = ?)";
        $stmt = $conn->prepare($grandTotalQuery);
        $stmt->bind_param("i", $_SESSION['uid']);
        $stmt->execute();
        $grandTotalResult = $stmt->get_result();
        $grandTotal = $grandTotalResult->fetch_assoc()['grand_total'];
        $stmt->close();

        // Prepare response
        $response = [
            'success' => true,
            'html' => $updatedRow,
            'grand_total' => $grandTotal,
            'item_total' => $totalPrice // Include item total for update
        ];
        echo json_encode($response);
        exit;
    }
}

// If something goes wrong
$response = [
    'success' => false,
    'message' => 'Failed to update cart item.'
];
echo json_encode($response);
exit;
?>