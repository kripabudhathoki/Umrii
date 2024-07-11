<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';

// Handle removing an item from the cart
if (isset($_POST['remove'])) {
    $remove_index = $_POST['remove'];
    unset($_SESSION['cart'][$remove_index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Handle clearing all items from the cart
if (isset($_POST['clear'])) {
    unset($_SESSION['cart']);
    $_SESSION['cart'] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
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
            filter: blur(1px); /* Adjust the blur intensity as needed */
            z-index: -1;
            padding: 5em 0;
            margin: 0 5%;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* The Popup (background) */
        .cart-popup {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Popup Content */
        .cart-popup-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 400px; /* Set a max-width for better design */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Subtle shadow */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        /* Styling for cart table */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
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

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        /* Additional styling */
        .clear-all-btn {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center center; padding: 5em 0; margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row intro-text left-0 text-center bg-faded p-5 rounded">
                <div class="col-md-12">
                    <div class="cart-list">
                        <form method="POST" action="cart.php">
                            <table class="table table-bordered">
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
                                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                                        <?php foreach($_SESSION['cart'] as $index => $item): ?>
                                            <tr class="text-center">
                                                <td class="product-remove">
                                                    <button type="submit" name="remove" value="<?php echo $index; ?>" class="btn btn-link">
                                                        <span class="bi bi-x-circle"></span>
                                                    </button>
                                                </td>
                                                <td class="image-prod">
                                                    <div class="img" style="background-image:url('assets/img/<?php echo $item['product_image']; ?>'); height: 100px; width:100px;"></div>
                                                </td>
                                                <td class="product-name">
                                                    <h4><?php echo $item['product_name']; ?></h4>
                                                </td>
                                                <td class="price">Rs. <?php echo $item['product_price']; ?></td>
                                                <td class="quantity">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="quantity-left-minus btn btn-outline-secondary" data-type="minus" data-field="">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" name="quantity" class="quantity form-control input-number text-center" value="<?php echo $item['quantity']; ?>" min="1" max="100" data-index="<?php echo $index; ?>" data-price="<?php echo $item['product_price']; ?>">
                                                        <div class="input-group-append">
                                                            <button type="button" class="quantity-right-plus btn btn-outline-secondary" data-type="plus" data-field="">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="total">Rs. <?php echo $item['product_price'] * $item['quantity']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="text-center">
                                            <td colspan="6">
                                                <!-- Clear All Button -->
                                                <button type="submit" name="clear" class="btn btn-danger clear-all-btn">Clear All</button>
                                                <!-- Grand Total Display -->
                                                <div class="cart-total mb-3">
                                                    <h3>Cart Total</h3>
                                                    <p class="d-flex">
                                                        <span>Grand Total: </span>
                                                        <span id="grand-total">
                                                            <?php
                                                            $grand_total = 0;
                                                            if(isset($_SESSION['cart'])) {
                                                                foreach($_SESSION['cart'] as $item) {
                                                                    $grand_total += $item['product_price'] * $item['quantity'];
                                                                }
                                                            }
                                                            echo 'Rs. ' . $grand_total;
                                                            ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr class="text-center">
                                            <td colspan="6">Your cart is empty</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alert for cart messages -->
    <?php if(isset($_SESSION['cart_alert'])): ?>
        <script>
            alert("<?php echo $_SESSION['cart_alert']; ?>");
            <?php unset($_SESSION['cart_alert']); ?>
        </script>
    <?php endif; ?>

    <script>
    // Handle quantity changes dynamically with plus and minus buttons
    document.querySelectorAll('.quantity-left-minus').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.closest('.input-group').querySelector('.quantity');
            var value = parseInt(input.value);
            var index = input.getAttribute('data-index');
            var price = parseFloat(input.getAttribute('data-price'));

            if (value > 1) {
                value--;
                input.value = value;
                var total = price * value;
                this.closest('tr').querySelector('.total').innerText = 'Rs. ' + total;

                // Update the session cart quantity
                updateCartQuantity(index, value);
                updateGrandTotal();
            }
        });
    });

    document.querySelectorAll('.quantity-right-plus').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.closest('.input-group').querySelector('.quantity');
            var value = parseInt(input.value);
            var index = input.getAttribute('data-index');
            var price = parseFloat(input.getAttribute('data-price'));

            if (value < 100) {
                value++;
                input.value = value;
                var total = price * value;
                this.closest('tr').querySelector('.total').innerText = 'Rs. ' + total;

                // Update the session cart quantity
                updateCartQuantity(index, value);
                updateGrandTotal();
            }
        });
    });

    function updateCartQuantity(index, quantity) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_cart_quantity.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('index=' + index + '&quantity=' + quantity);
    }

    function updateGrandTotal() {
        var grand_total = 0;
        document.querySelectorAll('.quantity').forEach(function(input) {
            var value = parseInt(input.value);
            var price = parseFloat(input.getAttribute('data-price'));
            grand_total += value * price;
        });
        document.getElementById('grand-total').innerText = 'Rs. ' + grand_total;
    }
    </script>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
