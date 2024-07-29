<?php
include "dbconnect.php";
session_start();

// Fetch featured products
$query = "SELECT * FROM products WHERE isFeatured IN (1, 2)";
$result = mysqli_query($conn, $query);

$featuredProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $featuredProducts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php
    include('navbar.php')?>
    <!--nav end-->
    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/file.jpg" alt="..." />
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower" style="color: white;"><b>Worth Drinking</b></span>
                    </h2>
                    <p class="mb-3" style="color: white;">Every cup of our quality refreshing summer drinks starts with locally sourced, hand picked ingredients. Once you try it, our drinks will be a blissful addition to your everyday summer routine - we guarantee it!</p>
                    <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" style="color: white;" href="index.php"><b>Visit Us Today!</b></a></div>
                </div>
            </div>
        </div>
    </section>
    <!--section 2-->
    <section class="page-section clearfix">
        <div class="container">
            <?php foreach ($featuredProducts as $product): ?>
                <article class="postcard dark <?php echo $product['isFeatured'] == 1 ? 'blue' : 'red'; ?>"> 
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="assets/img/<?php echo $product['product_image']; ?>" alt="Image Title" />
                    </a>
                    <div class="postcard__text">
                        <h1 class="postcard__title <?php echo $product['isFeatured'] == 1 ? 'blue' : 'red'; ?>"><a href="#"><b><?php echo $product['product_name']; ?></b></a></h1>
                        <b><?php echo $product['isFeatured'] == 1 ? 'BEST SELLER' : 'YOU\'RE SPECIAL'; ?></b>
                        <div class="postcard__subtitle small"></div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt"><?php echo htmlspecialchars($product['product_description']); ?></div>
                        <ul class="postcard__tagbox">
                            <li class="tag__item"><i class="fas fa-tag mr-2"></i><b>Price: <?php echo $product['product_price']; ?></b></li>
                            <li class="tag__item play <?php echo $product['isFeatured'] == 1 ? 'blue' : 'red'; ?>">
                            <a href="product-detail.php?pid=<?php echo $product['pid']; ?>"><b>BUY NOW!</b></a>
                            </li>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="page-section cta">
        <div class="container-gallery">
            <div class="popup popup-1">
                <img class="img-responsive" alt="Pop Up Gallery" src="assets/img/gallery1.jpg" />
            </div>
            <div class="popup popup-2">
                <img class="img-responsive" alt="Pop Up Gallery" src="assets/img/gallery2.jpg" />
            </div>
            <div class="popup popup-3">
                <img class="img-responsive" alt="Pop Up Gallery" src="assets/img/gallery5.jpg" />
            </div>
            <div class="popup popup-4">
                <img class="img-responsive" alt="Pop Up Gallery" src="assets/img/gallery3.jpg" />
            </div>
            <div class="popup popup-5">
                <img class="img-responsive" alt="Pop Up Gallery" src="assets/img/gallery4.jpg" />
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php 
    include('footer.php')
    ?>
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
