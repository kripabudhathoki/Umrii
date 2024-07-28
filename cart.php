<?php
session_start();
include('navbar.php');
$cart_items = [];
include 'dbconnect.php';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
if ($uid > 0) {
    $query = "SELECT ci.cart_item_id, p.product_name, ci.quantity, ci.unit_price, (ci.quantity * ci.unit_price) as total_price, p.product_image
              FROM cart_items ci
              JOIN products p ON ci.pid = p.pid
              WHERE ci.cart_id = (SELECT cart_id FROM cart WHERE uid = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cart_items[] = $row;
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UMRII - My Cart</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
    /* Hero Section */
    .hero-wrap {
        position: relative;
        overflow: hidden;
    }
    .hero-wrap::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('assets/img/background1.jpg');
        background-size: cover;
        background-position: center;
        filter: blur(1px);
        z-index: -1;
        padding: 5em 0;
        margin: 0 5%;
    }
    .hero-content {
        position: relative;
        z-index: 1;
    }

    /* Cart Popup */
    .cart-popup {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }
    .cart-popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover, .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Table Styles */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }
    .table .table {
        background-color: #fff;
    }
    .table-sm th, .table-sm td {
        padding: 0.3rem;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }
    .table-bordered thead th, .table-bordered thead td {
        border-bottom-width: 2px;
    }

    .text-center {
        text-align: center !important;
    }
    .text-right {
        text-align: right !important;
    }

    .clear-all-btn {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center center; padding: 5em 0; margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <h1 class="mb-0 bread"><b>My Cart</b></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row intro-text left-0 text-center bg-faded p-5 rounded">
                <div class="col-md-12">
                    <div class="cart-list">
                        <table class="table table-bordered" id="cartTable">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($cart_items)) {
                                    foreach ($cart_items as $item) {
                                        ?>
                                        <tr class="text-center" data-cart-item-id="<?php echo $item['cart_item_id']; ?>">
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
                                            <td class="price">Rs. <?php echo $item['unit_price']; ?></td>
                                            <td class="quantity">
                                                <input type="number" class="form-control update-quantity" data-cart-item-id="<?php echo $item['cart_item_id']; ?>" value="<?php echo $item['quantity']; ?>" min="1">
                                            </td>
                                            <td class="total">Rs. <?php echo $item['total_price']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr class="text-center">
                                        <td colspan="6">Your cart is empty</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-right">
                        <button type="button" id="clearAll" class="btn btn-danger clear-all-btn d-flex justify-content-start">Clear All</button>
                            <strong>Grand Total: <span id="grandTotal">Rs. <?php echo array_sum(array_column($cart_items, 'total_price')); ?></span></strong>
                            <a href="checkout.php"><button type="submit" name="checkout" class="btn btn-success d-flex justify-content-center" style="margin-left: 40%;">Proceed to checkout</button></a>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
   $(document).ready(function() {
    function updateTotals(response) {
        if (response.success) {
            var cartItemId = response.cartItemId;
            var $row = $('#cartTable').find('tr[data-cart-item-id="' + cartItemId + '"]');
            $row.find('.quantity input').val(response.quantity);
            $row.find('.total').text('Rs. ' + parseFloat(response.totalPrice).toFixed(0));
            $('#grandTotal').text('Rs. ' + parseFloat(response.grandTotal).toFixed(0));
        }
    }

    $('.update-quantity').change(function() {
        var cartItemId = $(this).data('cart-item-id');
        var quantity = $(this).val();
        $.ajax({
            url: 'update_cart.php',
            method: 'POST',
            data: {
                cart_item_id: cartItemId,
                quantity: quantity
            },
            success: function(response) {
                response = JSON.parse(response);
                updateTotals(response);
            }
        });
    });

    $('.remove-item').click(function() {
        var cartItemId = $(this).data('cart-item-id');
        $.ajax({
            url: 'delete_cart_item.php',
            method: 'POST',
            data: {
                cart_item_id: cartItemId
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    var $row = $('#cartTable').find('tr[data-cart-item-id="' + cartItemId + '"]');
                    $row.remove();
                    $('#grandTotal').text('Rs. ' + parseFloat(response.grandTotal).toFixed(0));
                    if (response.grandTotal === 0) {
                        $('#cartTable tbody').html('<tr class="text-center"><td colspan="6">Your cart is empty</td></tr>');
                    }
                    updateCartCount();
                }
            }
        });
    });

    function updateCartCount() {
        $.ajax({
            url: 'get_cart_count.php',
            type: 'GET',
            success: function(response) {
                $('#cart-count').text(response);
            }
        });
    }

    $('#clearAll').click(function() {
        $.ajax({
            url: 'clear_cart.php',
            method: 'POST',
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    $('#cartTable tbody').html('<tr class="text-center"><td colspan="6">Your cart is empty</td></tr>');
                    $('#grandTotal').text('Rs. 0');
                    updateCartCount();
                }
            }
        });
    });
});

    </script>
</body>
</html>