<?php
include "dbconnect.php"; // Include your database connection file

// Query to fetch products from the database
$sql = "SELECT * FROM products";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UMRII</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet">
    <style>
        .card {
            max-width: 540px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .card-body {
            padding: 1rem;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    
    <section class="page-section">
        <div class="container">
            <div class="card">
                <div class="row g-0" style="margin: -8% 0%;">
                    <div class="col-md-4">
                        <img src="assets/img/<?php echo $product_image; ?>" class="img-fluid card-img-top" alt="<?php echo $product_name; ?>" style="margin: 24% 0%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="margin: 20% 0%;">
                            <h5 class="card-title"><?php echo $product_name; ?></h5>
                            <p class="card-text"><?php echo $product_description; ?></p>
                            <p class="card-text">Price: $<?php echo $product_price; ?></p>
                        </div>
                    </div></div>
                    <div class="card-footer">
                            <a href="product-detail.php?pid=<?php echo $row['pid']; ?>" class="btn-icon" title="View Details">
                                <i class="fas fa-info-circle" style="margin: 0% 35%;font-size: small;">View Detail</i>
                            </a>
                            <a href="cart.php" title="Add to Cart">
                                <i class="fas fa-cart-plus" style="margin: 0% 35%;font-size: small;">Add to Cart</i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('footer.php'); ?>
    
    <!-- Bootstrap core JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    } // End of while loop
} else {
    echo "No products found";
}
mysqli_close($conn); // Close database connection
?>