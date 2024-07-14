<?php
session_start();
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $product_name = $_POST['product_name'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $product_image = $_POST['image'];
    
    $sql = "INSERT INTO review (name, product_name, rating, review, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $name, $product_name, $rating, $review,$product_image);

    if ($stmt->execute()) {
        echo "<script>
                alert('New review created successfully');
                window.location.href = 'review.php';
              </script>";
    } else {
        $signup_error['database'] = "Error: " . $stmt->error;
        echo "<script>
                alert('Error: " . $stmt->error . "');
              </script>";
    }
    $stmt->close();
}

// Fetch 5-star reviews
$sql = "SELECT * FROM review WHERE rating = 5";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BB676B !important;
        }
        .form-container {
            background: #BB676B !important;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 0%;
        }
        .review-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-top: 20px;
            background: #bdadad9e;
        }
        .review-card:hover {
            transform: scale(1.05);
        }
        .review-rating {
            color: #FFD700 !important;
            font-size: 1.2rem;
        }
        .review-text {
            font-style: italic;
        }
        .reviewer-name {
            font-weight: bold;
        }
        .reviewer-image {
            max-width: 80px;
            border-radius: 50%;
        }
        .star-rating {
            direction: rtl;
            display: inline-block;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #bbb;
            font-size: 2rem;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        .star-rating input[type="radio"]:checked ~ label {
            color: #f8d64e;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f8d64e;
        }
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

        .cart-popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
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
            background-color: rgb(0, 0, 0); /* Fallback color */
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
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>

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
                        <img src="assets/img/<?php echo htmlspecialchars($review['image']); ?>" alt="Reviewer Image" class="reviewer-image mr-3">
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
                    <form id="reviewForm" method="POST" action="review.php">
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
                                <input type="radio" id="5-star" name="rating" value="5">
                                <label for="5-star" class="star">&#9733;</label>
                                <input type="radio" id="4-star" name="rating" value="4">
                                <label for="4-star" class="star">&#9733;</label>
                                <input type="radio" id="3-star" name="rating" value="3">
                                <label for="3-star" class="star">&#9733;</label>
                                <input type="radio" id="2-star" name="rating" value="2">
                                <label for="2-star" class="star">&#9733;</label>
                                <input type="radio" id="1-star" name="rating" value="1">
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
    </script>

</body>
</html>
