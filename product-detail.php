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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <!-- Include full version of jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
        filter: blur(1px);
        z-index: -1;
        padding: 5em 0;
        margin: 0 5%;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .product-detail-card {
    display: flex;
    background: gainsboro;
    padding: 0.1em;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 80%;
    margin-top: 5%;
}

    .product-detail-card img {
        border-radius: 15px 0px 0px 15px;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .product-detail-card .product-image {
        flex: 1;
        max-width: 50%;
    }

    .product-detail-card .product-info {
        flex: 1;
        padding-left: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-detail-card .price span {
        font-size: 2rem;
        color: #A54A4E;
        font-weight: bold;
    }

    .quantity-buttons .input-group-btn button {
        border-radius: 50%;
    }
</style>

<div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
            <div class="col-md-9 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a></a></span> <span></span></p>
                <h1 class="mb-0 bread"><b>Product Details</b></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="product-detail-card">
                    <div class="product-image">
                        <a href="assets/img/<?php echo $product['product_image']; ?>" class="image-popup">
                            <img src="assets/img/<?php echo $product['product_image']; ?>" class="img-fluid" alt="Product Image">
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><?php echo $product['product_name']; ?></h3>
                        <p class="price"><span>Rs. <?php echo $product['product_price']; ?></span></p>
                        <p><?php echo $product['product_description']; ?></p>
                        <form id="add-to-cart-form">
                            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                            <input type="hidden" id="quantity" name="quantity" value="1">
                            <div class="row mt-4">
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn btn-outline-secondary" data-type="minus">
                                            <span class="bi bi-dash"></span>
                                        </button>
                                    </span>
                                    <input type="number" id="quantity-display" name="quantity-display" class="form-control input-number" value="1" min="1" max="10">
                                    <span class="input-group-btn ml-2">
                                        <button type="button" class="quantity-right-plus btn btn-outline-secondary" data-type="plus">
                                            <span class="bi bi-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                           
<div id="cart-alert" class="alert" style="display:none;"></div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
    // Quantity increment and decrement
    $('.quantity-right-plus').click(function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity-display').val());
        if (quantity < 10) {
            $('#quantity-display').val(quantity + 1);
            $('#quantity').val(quantity + 1); 
        }
    });

    $('.quantity-left-minus').click(function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity-display').val());
        if (quantity > 1) {
            $('#quantity-display').val(quantity - 1);
            $('#quantity').val(quantity - 1); 
        }
    });

    $('#add-to-cart-form').submit(function(e) {
    e.preventDefault();
    console.log('Form submitted'); 
    var form = $(this);
    $.ajax({
        url: 'add_to_cart.php',
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
            console.log(response); 
            if (response.success) {
                updateCartCount();
                $('#cart-alert').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
            } else {
                $('#cart-alert').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
            }
        },
        error: function() {
            $('#cart-alert').removeClass('alert-success').addClass('alert-danger').text('An error occurred. Please try again.').show();
        }
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

            
        });

});
</script>
</body>
</html>