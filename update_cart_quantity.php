<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItemId = $_POST['cartItemId'];
    $quantity = $_POST['quantity'];

    // Update cart item quantity in the database
    $sql = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $quantity, $cartItemId);
    $stmt->execute();

    // Fetch updated cart items
    $cart_items = [];
    $result = $conn->query("SELECT * FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id");
    while ($row = $result->fetch_assoc()) {
        $row['total_price'] = $row['unit_price'] * $row['quantity'];
        $cart_items[] = $row;
    }

    // Return updated cart table rows
    foreach ($cart_items as $item) {
        ?>
        <tr class="text-center">
            <td class="product-remove">
                <button class="btn btn-link remove-item" data-cart-item-id="<?php echo $item['cart_item_id']; ?>">
                    <span class="bi bi-x-circle"></span>
                </button>
            </td>
            <td class="image-prod">
                <img src="assets/img/<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>" style="height: 100px; width: 100px;">
            </td>
            <td class="product-name">
                <h4><?php echo $item['product_name']; ?></h4>
            </td>
            <td class="price">$ <?php echo $item['unit_price']; ?></td>
            <td class="quantity">
                <input type="number" class="form-control update-quantity" data-cart-item-id="<?php echo $item['cart_item_id']; ?>" value="<?php echo $item['quantity']; ?>" min="1">
            </td>
            <td class="total">$ <?php echo $item['total_price']; ?></td>
        </tr>
        <?php
    }
}
?>