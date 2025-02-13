<?php
session_start();
include "dbconnect.php";

$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
// Fetch 5-star reviews
$sql = "SELECT * FROM review WHERE rating = 5 ORDER BY review_id DESC LIMIT 3";
$result = $conn->query($sql);
$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

// Fetch product names
$sql_products = "SELECT pid, product_name FROM products";
$result_products = $conn->query($sql_products);
$product_names = [];
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $product_names[] = $row;
    }
    
}
$conn->close();
?>

<?php 

// On review.php

if (isset($_SESSION['show_popup']) && $_SESSION['show_popup'] == true) {
  ?>
  <div id="ReviewSuccessPopup" style="display: none;">
        <h2>Review was Successfully Submitted!</h2>
    </div>
    <style>
        #ReviewSuccessPopup {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #f7f7f7; /* Light gray background */
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensure popup is on top of other elements */
            width: 350px; /* Set a fixed width for the popup */
            text-align: center; /* Center the text horizontally */
        }

        #ReviewSuccessPopup h2 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        </style>
  <script>
    window.onload = function() {
        document.getElementById("ReviewSuccessPopup").style.display = "block";

// Hide the popup after 5 seconds
setTimeout(function() {
    document.getElementById("ReviewSuccessPopup").style.display = "none";
}, 5000);
    };
  </script>
  <?php
  unset($_SESSION['show_popup']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/review.css">
</head>
<body>
    <?php include('navbar.php'); ?>

<div class="myorders" style="min-height: 100vh;">
    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a></a></span> <span></span></p>
                    <h1 class="mb-0 bread"><b>Review</b></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">

            <?php foreach ($reviews as $review): ?>
                <div class="col-md-4">
                    <div class="review-card d-flex align-items-center" style="background:#bdadad9e;">
                        <img src="uploads/<?php echo htmlspecialchars($review['image']); ?>" alt="Reviewer Image" class="reviewer-image mr-3">
                        <div>
                            <h4 class="mb-0"><?php echo htmlspecialchars($review['product_name']); ?></h4>
                            <div class="review-rating">
                                &#9733; &#9733; &#9733; &#9733; &#9733;
                            </div>
                            <div class="review-text mt-2">
                                "<?php echo htmlspecialchars($review['review']); ?>"
                            </div>
                            <div class="reviewer-name mt-3">
                                - <?php echo htmlspecialchars($review['name']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

           
    </div>

    <div class="container mt-5">
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <div class="bg-white p-5 contact-form" style="margin-left: 20%; margin-top: -20px;margin-bottom: 25px;">
                    <h2>Submit Your Review</h2>
                    <form id="reviewForm" method="POST" action="review_func.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <br>
                            <input type="text" class="form-control" id="reviewerName" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <br>
                            <select class="form-control" id="product_name" name="product_name" required>
                                <option value="">Select Product</option>
                                <?php foreach ($product_names as $product): ?>
                                    <option value="<?php echo htmlspecialchars($product['product_name']); ?>"><?php echo htmlspecialchars($product['product_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reviewRating" class="mr-3">Rating:</label>
                            <div class="star-rating">
                                <input type="radio" id="5-star" name="rating" value="5" required>
                                <label for="5-star" class="star">&#9733;</label>
                                <input type="radio" id="4-star" name="rating" value="4" required>
                                <label for="4-star" class="star">&#9733;</label>
                                <input type="radio" id="3-star" name="rating" value="3" required>
                                <label for="3-star" class="star">&#9733;</label>
                                <input type="radio" id="2-star" name="rating" value="2" required>
                                <label for="2-star" class="star">&#9733;</label>
                                <input type="radio" id="1-star" name="rating" value="1" required>
                                <label for="1-star" class="star">&#9733;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="reviewText" rows="3" name="review" placeholder="Your Review" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="FILE" class="form-control" id="image" rows="3" name="image" placeholder="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary justify-content-center" name="submit" style="margin: 2% 40%;">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex" style="margin-top: -50px;margin-bottom: 25px;">
                <div id="map" class="img-popup"><img src="assets/img/review1.jpg" alt="img-fluid" class="reviewer-image mr-3" style="max-width: 70%;margin-top: 5%;margin-left: 17%;"></div>
            </div>
        </div>
        <div id="reviewsContainer" class="row"></div>
    </div>
                                </div>
                                </div>
    <?php include('footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to update cart count dynamically
            function updateCartCount() {
                $.ajax({
                    url: 'get_cart_count.php',
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response);
                    }
                });
            }

            updateCartCount(); // Call initially on page load

            // Optionally, you can set an interval to update cart count periodically
            // setInterval(updateCartCount, 30000); // Update every 30 seconds

            
        });

        document.getElementById("reviewForm").addEventListener("submit", function(event) {
            <?php if (!$is_logged_in): ?>
                event.preventDefault();
                window.location.href = "login.php";
            <?php endif; ?>
        });
    </script>

</body>
</html>