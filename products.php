<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';

// Set the number of products to show per page
$productsPerPage = 6;

// Get the current page number from the URL, default 1 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset based on the current page
$offset = ($page - 1) * $productsPerPage;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UMRII</title>
    <link rel="stylesheet" href="css/products.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

    <?php include('navbar.php'); ?>
    <div class="myorders" style="min-height: 100vh;">
    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a></a></span> <span></span></p>
                    <h1 class="mb-0 bread"><b>Product</b></h1>
                </div>
            </div>
        </div>
    </div>
    
    <section class="page-section">
        <div class="container">
            <div class="row">
                <?php
                include "dbconnect.php"; // Include your database connection file

                // Query to fetch products from the database
                $sql = "SELECT * FROM products LIMIT $offset, $productsPerPage";
                $result = mysqli_query($conn, $sql);

                // Check if there are any products
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_name = $row['product_name'];
                        $product_image = $row['product_image'];
                        $product_description = $row['product_description'];
                        $product_price = $row['product_price'];
                ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="assets/img/<?php echo $product_image; ?>" class="img-fluid card-img-top" alt="<?php echo $product_name; ?>">
                                    </div>
                                    <div class="col-md-8 h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><b><?php echo $product_name; ?></b></h5>
                                            <p class="card-text" id="desc_<?php echo $row['pid']; ?>"><?php echo $product_description; ?></p>
                                            <p class="card-price" style="color:#A54A4E;"><b>Price: Rs <?php echo $product_price; ?></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="product-detail.php?pid=<?php echo $row['pid']; ?>" class="btn-icon" title="View Details">
                                        <i class="fas fa-info-circle" style="font-size: small;"> View Detail</i>
                                    </a>
                                    <a href="#" class="btn-icon btn-add-to-cart" data-pid="<?php echo $row['pid']; ?>" title="Add to Cart">
                                        <i class="fas fa-cart-plus" style="margin: 0%; font-size: small;"> Add to Cart</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    } // End of while loop
                } else {
                    echo "No products found";
                }
                ?>
                <div class="container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                // Create previous page button
                $prevPage = $page - 1;
                echo "<li class='page-item " . ($page <= 1 ? 'disabled' : '') . "'>
                        <a class='page-link' href='products.php?page=$prevPage' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                        </a>
                    </li>";

                // Create page numbers
                for ($i = 1; $i <= ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products")) / $productsPerPage); $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'>
                            <a class='page-link' href='products.php?page=$i'>$i</a>
                        </li>";
                }

                // Create next page button
                $nextPage = $page + 1;
                echo "<li class='page-item " . ($page >= ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products")) / $productsPerPage) ? 'disabled' : '') . "'>
                        <a class='page-link' href='products.php?page=$nextPage' aria-label='Next'>
                            <span aria-hidden='true'>&raquo;</span>
                        </a>
                    </li>";
                ?>
            </ul>
        </nav>
    </div>
                <?php
                mysqli_close($conn); // Close database connection
                ?>
            </div>
        </div>
    </section>

            </div>
    <?php include('footer.php'); ?>
    
    <!-- Bootstrap core JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Initialize word limit for product descriptions -->
    <script>
function limitWords(descriptionElement, limit) {
    var words = descriptionElement.textContent.trim().split(/\s+/);
    if (words.length > limit) {
        descriptionElement.textContent = words.slice(0, limit).join(" ") + "... click view details";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var productDescriptions = document.querySelectorAll('.card-text');
    var wordLimit = 10; // Adjust word limit as needed

    productDescriptions.forEach(function(description) {
        limitWords(description, wordLimit);
    });
});
</script>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script>
            $(document).ready(function () {
    // Event listener for add-to-cart button
    $('.btn-add-to-cart').on('click', function (e) {
        e.preventDefault();

        var pid = $(this).data('pid'); // Get product ID
        var quantity = 1; // Default quantity

        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: { pid: pid, quantity: quantity },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                showPopup("Item added to cart!"); // Show the popup message
                updateCartCount(); 
                } else if (response.popup) {
                    showPopup("Item already in cart!"); 
                    // Show the popup message
                // var message = $('#product-already-added');
                // message.text("Product already added to cart!"); // Set the message text
                // message.addClass('visible'); // Show the message

                // // Add some animation to the message
                // message.css('opacity', 0);
                // message.animate({ opacity: 1 }, 500);

                // // Hide the message after 3 seconds
                // setTimeout(function () {
                //     message.animate({ opacity: 0 }, 500, function () {
                //     message.removeClass('visible');
                //     });
                // }, 3000);
                } else if (response.alert) {
                alert(response.message);
                } else {
                if (response.redirect) {
                    window.location.href = response.redirect; // Redirect if needed
                } else {
                    alert(response.message); // Show error message
                }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
            });
                });

    // Function to show popup
    function showPopup(message) {
  var popup = $('#popupMessage');
  popup.text(message); // Set the popup message
  popup.addClass('visible'); // Show popup

  // Add some animation to the popup message
  popup.css('opacity', 0);
  popup.animate({ opacity: 1 }, 500);

  // Hide the popup after 3 seconds
  setTimeout(function () {
    popup.animate({ opacity: 0 }, 500, function () {
      popup.removeClass('visible');
    });
  }, 3000);
}

    // Optional: Function to update cart count
    function updateCartCount() {
        $.ajax({
            url: 'get_cart_count.php',
            type: 'GET',
            success: function (response) {
                $('#cart-count').text(response);
            },  
            error: function (xhr, status, error) {
                console.error('Error fetching cart count:', error);
            },
        });
    }
});

</script>

<div id="popupMessage" class="popup-message hidden">Item added to cart!</div>
</body>
</html>