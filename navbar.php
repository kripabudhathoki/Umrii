<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <!-- Include full version of jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateCartCount() {
                $.ajax({
                    url: 'get_cart_count.php', 
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response); 
                    }
                });
            }

            updateCartCount();
        });
    </script>
    <style>
        /* Ensure navbar items are visible */
        .navbar-light .navbar-nav .nav-link {
            color: #ffffff; /* White color for nav links */
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #f8f9fa; /* Slightly lighter on hover */
        }

        .btn-outline-light {
            color: #ffffff; /* Ensure button text is visible */
            border-color: #ffffff; /* Border color for buttons */
        }

        .btn-outline-light:hover {
            background-color: #ffffff; /* Background color on hover */
            color: #000000; /* Text color on hover */
        }


        .navbar-toggler {
            border-color: #ffffff;
        }

        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"%3E%3Cpath stroke="%23ffffff" stroke-width="2" d="M5 7h20M5 15h20M5 23h20"/%3E%3C/svg%3E'); 
        }

        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
</head>
<body>
<header>
    <h1 class="site-heading text-center text-faded d-none d-lg-block">
        <div class="topbar">
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
    
<nav class="navbar navbar-expand-lg navbar-light sticky-top py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.php">
            <h1 class="display-6"><img src="assets/img/logoW.png" class="main-logo" /></h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">About</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Products</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="contact.php">Contact</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="review.php">Review</a></li>
            </ul>
            <form class="d-flex ms-lg-3 my-2 my-lg-0" action="search.php" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-light" type="submit" style="color: #A54A4E;"><i class="bi bi-search"></i></button>
            </form>
            <form class="d-flex ms-lg-3 my-2 my-lg-0" action="cart.php" method="POST">
                <button class="btn btn-outline-light position-relative" type="submit" style="color: #A54A4E;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                        <!-- Cart count will be updated dynamically -->
                    </span>
                    <i class="bi bi-cart4"></i>
                </button>
            </form>
            <div class="d-flex align-items-center ms-lg-3">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                    <a href='logout.php' class='position-relative me-3'>
                        <i class="fas fa-solid fa-right-from-bracket fa-2x"></i>
                    </a>
                <?php else : ?>
                    <a href='login.php' class='nav-link'>
                        <button type='button' class="btn btn-primary" style="color:#A54A4E; background-color:#e6a756;margin-left: 12px; margin-right: -50px;"><b>Log In</b></button>
                    </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['username'])) : ?>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0; display: flex; align-items: center;">
                            <i class="bi bi-person"></i> <?= $_SESSION['username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="myprofile.php"><i class="bi bi-person-circle"></i> My Profile</a>
                            <a class="dropdown-item" href="myorder.php"><i class="bi bi-box-seam"></i> My Orders</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>