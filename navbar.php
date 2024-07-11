<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="topbar bg-primary">
            <div class="container">
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
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <form class="d-flex ms-auto my-auto" action="search.php" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-light" type="submit" style="color: #A54A4E;"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="d-flex ms-auto my-auto" action="cart.php" method="POST">
                        <button class="btn btn-outline-light position-relative" type="submit" style="color: #A54A4E;">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                                <span class="visually-hidden">items in cart</span>
                            </span>
                            <i class="bi bi-cart4"></i>
                        </button>
                    </form>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                        <a href='logout.php' class='position-relative ms-3 my-auto'>
                            <i class='fas fa-solid fa-right-from-bracket fa-2x'></i>
                        </a>
                    <?php else : ?>
                        <a href='login.php' class='nav-link text-uppercase'>
                            <button type='button' class='btn btn-primary' style='color:#A54A4E; background-color:#e6a756; margin-left: 12px;margin-right: -50px;'><b>Log In</b></button>
                        </a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <a class="nav-link">
                            <i class="bi bi-person"></i> <?= $_SESSION['username']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
