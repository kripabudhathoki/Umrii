<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';

// Include your database connection file
include "dbconnect.php";

// Get the product ID from the query string
$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

// Fetch the product details from the database
$sql = "SELECT * FROM products WHERE pid = $pid";
$result = mysqli_query($conn, $sql);

// Check if the product exists
if (mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Product not found";
    exit;
}

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!$is_logged_in) {
        header("Location: login.php");
        exit;
    }

    $quantity = intval($_POST['quantity']);
    $cart_item = [
        'pid' => $pid,
        'product_name' => $product['product_name'],
        'product_image' => $product['product_image'],
        'product_price' => $product['product_price'],
        'quantity' => $quantity
    ];

    // Initialize cart if not already
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add item to cart
    $_SESSION['cart'][$pid] = $cart_item;
    header("Location: cart.php");
    exit;
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
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
<?php include('navbar.php'); ?>
    <!-- END nav -->
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
    </style>

    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <h1 class="mb-0 bread">Product Details</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="row intro-text left-0 text-center bg-faded p-5 rounded">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="assets/img/<?php echo $product['product_image']; ?>" class="image-popup">
                    <img src="assets/img/<?php echo $product['product_image']; ?>" class="img-fluid" alt="Product Image">
                </a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate" style="top: 50px;">
                <h3><?php echo $product['product_name']; ?></h3>
                <p class="price" style="font-size: x-large;"><span>Rs. <?php echo $product['product_price']; ?></span></p>
                <p><?php echo $product['product_description']; ?></p>
                <form method="post" action="">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <div class="select-wrap">
                                    <select name="size" id="size" class="form-control">
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                        <option value="Extra Large">Extra Large</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn btn-outline-secondary" data-type="minus" data-field="">
                                    <span class="bi bi-dash"></span>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn btn-outline-secondary" data-type="plus" data-field="">
                                    <span class="bi bi-plus"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <p><button type="submit" name="add_to_cart" class="btn btn-primary py-3 px-5">Add to Cart</button></p>
                </form>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Products</span>
                    <h2 class="mb-4">Related Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>    		
        </div>
        <div class="container">
            <div class="row">
                <!-- Add related products here -->
            </div>
        </div>
    </section>

<?php include('footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined
                $('#quantity').val(quantity + 1);
            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });
        });
    </script>
</body>
</html>

<?php
mysqli_close($conn); // Close database connection
?>
