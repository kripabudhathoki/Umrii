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
    <header>
        <h1 class="site-heading text-center text-faded d-none d-lg-block">
            <div class="topbar bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><a class="text-white"><b>Lalitpur, Nepal</b></a></small>
                        <small class="me-3"><a class="text-white"><b>umrii.np@gmail.com</b></a></small>
                    </div>
                    <div class="top-link pe-2">
                        <small class="me-3"><a class="text-white"><b>+977 9828884567</b></a></small>
                    </div>
                </div>
            </div>
            <a href="index.php" class="navbar-brand">
                <h1 class="display-6"><img src="assets/img/logoW.png" class="main-logo" /></h1>
            </a>
        </h1>
    </header>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">About</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Products</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="contact.php">Contact</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="review.php">Review</a></li>
                </ul>
                <form class="d-flex ms-auto my-auto" method="POST" action="search.php"> 
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name = "search">
                    <button class="btn btn-outline-light" type="submit" style="color: #A54A4E;"><i class="bi bi-search"></i></button>
                </form>
                <form class="d-flex ms-auto my-auto" action="cart.php" method="POST">
                <button class="btn btn-outline-light position-relative" type="submit" style="color: #A54A4E;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                        <!-- Cart count will be updated dynamically -->
                    </span>
                    <i class="bi bi-cart4"></i>
                </button>
            </form>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        $loggedin = true;
                    } else {
                        $loggedin = false;
                    }
                    if (!$loggedin) {
                        echo "<a href='login.php' class='nav-link text-uppercase'><button type='button' class='btn btn-primary' style='color:#A54A4E; background-color:#e6a756;margin-left: 12px; margin-right: -50px;'><b>Log In</b></button></a>";
                    } else {
                        echo "<a href='logout.php' class='position-relative ms-3 my-auto'><i class='fas fa-solid fa-right-from-bracket fa-2x'></i></a>";
                    }
                ?>
                <a>
                    <?php if (isset($_SESSION['username'])) {
                        echo '<a class="nav-link"><i class="bi bi-person"></i>' . " " . $_SESSION['username'] . '</a>';
                    }
                    ?>
            </div>
        </div>
    </nav></div>
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
                    <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" style="color: white;" href="product.php"><b>Visit Us Today!</b></a></div>
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
